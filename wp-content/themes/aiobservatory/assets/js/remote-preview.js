// Provider outages must leave a useful link, not a broken image frame.
(function () {
  document.querySelectorAll('img[data-remote-preview]').forEach(function (image) {
    function unavailable() {
      image.hidden = true;
      image.parentElement.querySelector('.media-status').hidden = false;
    }
    image.addEventListener('error', unavailable);
    if (image.complete && image.naturalWidth === 0) unavailable();
  });
}());
