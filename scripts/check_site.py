"""Run with python scripts/check_site.py; no third-party packages required."""
from html.parser import HTMLParser
from pathlib import Path
from urllib.parse import urlsplit
import re
import unittest

ROOT = Path(__file__).resolve().parents[1]

class Tags(HTMLParser):
    def __init__(self, text):
        super().__init__()
        self.tags = []
        self.feed(text)

    def handle_starttag(self, tag, attrs):
        self.tags.append((tag, dict(attrs)))

class SitePaths(unittest.TestCase):
    def test_theme_pages_have_portable_links_and_assets(self):
        pages = [p for p in ROOT.rglob("*.html") if "/assets/css/style.css" in p.read_text()]
        self.assertEqual(len(pages), 14)
        for page in pages:
            for tag, attrs in Tags(page.read_text()).tags:
                for attr in ("href", "src", "poster", "srcset"):
                    value = attrs.get(attr, "")
                    if "wp-content/" in value:
                        self.assertTrue(value.startswith("/wp-content/"), (page, value))
                href = attrs.get("href", "")
                if tag == "a" and href and not urlsplit(href).scheme and not href.startswith("#"):
                    self.assertFalse(href.startswith(".."), (page, href))
                    self.assertNotIn("//", href, (page, href))
                    if href:
                        target = ROOT / urlsplit(href).path.lstrip("/") if href.startswith("/") else page.parent / urlsplit(href).path
                        self.assertTrue(target.is_file() or (target / "index.html").is_file(), (page, href))
                for attr in ("src", "poster", "srcset"):
                    value = attrs.get(attr, "")
                    urls = [item.strip().split()[0] for item in value.split(",")] if attr == "srcset" and value else [value]
                    for url in urls:
                        if url.startswith("/"):
                            self.assertTrue((ROOT / urlsplit(url).path.lstrip("/")).is_file(), (page, url))
                        self.assertFalse(url.startswith("http://"), (page, url))
                self.assertNotEqual(tag, "embed", page)
                if tag == "script" or (tag == "link" and attrs.get("rel") == "stylesheet"):
                    value = attrs.get("src" if tag == "script" else "href", "")
                    if value.startswith("/"):
                        self.assertTrue((ROOT / value.lstrip("/")).is_file(), (page, value))

    def test_all_imported_theme_stylesheets_exist(self):
        css = ROOT / "wp-content/themes/aiobservatory/assets/css/style.css"
        for url in re.findall(r'@import url\("([^" ]+)"\)', css.read_text()):
            if urlsplit(url).scheme:
                self.assertTrue(url.startswith("https://"), url)
            else:
                self.assertTrue((css.parent / url).is_file(), url)

    def test_css_dependencies_exist(self):
        for css in (ROOT / "wp-content/themes/aiobservatory/assets/css").glob("*.css"):
            for url in re.findall(r"url\([\"']?([^\"')]+)", css.read_text()):
                if not urlsplit(url).scheme:
                    self.assertTrue((css.parent / urlsplit(url).path).is_file(), (css, url))

    def test_icon_fonts_exist(self):
        css = ROOT / "wp-content/themes/aiobservatory/assets/css/simple-line-icons.css"
        for url in re.findall(r"url\('([^']+)'\)", css.read_text()):
            self.assertTrue((css.parent / urlsplit(url).path).is_file(), url)

if __name__ == "__main__":
    unittest.main()
