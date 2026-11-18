<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<div id="main">
<?php 
$array = array();
$tag = array();
$count = 0;
$search_name = '';
global $instagramObject;
if(isset($_GET['s'])){
    $search_name = $_GET['s'];
  if(is_object($instagramObject)){
$data = $instagramObject->searchUser($_GET['s']);
if($data->data){
    $array = $data->data;
    $count++;
}
}

if(is_object($instagramObject)){
$data = $instagramObject->getTag($_GET['s']);
if($data->data->media_count>0){
    $tag = $data->data;
    $count++;
}
}

}
//dd($tag);
?>
            <h1 class="fade">Search Instagram Users & Hashtag ,Posts</h1>
            <div class="search-header">
                <div class="fix">
                    <section>
                        <i class="icon-search"></i>
                        <form action="<?php echo site_url();?>">
                        <input type="text" name="s" class="searchKey-w" placeholder="Search for user, hashtag, posts" value="<?php echo $search_name;?>" autocapitalize="off" autocomplete="off">
                        <span class="clearSearch">×</span>
                        </form>
                    </section>
                </div>
            </div>
            <div class="container media">
                <div class="row">
                    <article class="right">
                        <!--ad-->
                        <div class="fixad s">
                        <?php dynamic_sidebar('search-sidebar');?>                         
                        </div>
                        <!--/ad-->
                    </article>
                    <div class="left grid search overhide">
                        <div class="row">
                         
                            <h3 class="name">
                                <span>Hot Users & Hashtag</span>
                            </h3>
                            <!--hotTags-->
                            <?php
                            if($tag){ ?>
                            <article>
                                <div class="card">
                                    <a href="<?php echo site_url('tag/?pid='.$tag->name)?>" target="_blank">
                                        <i>#</i>
                                        <strong><?php echo $tag->name;?></strong>
                                        <br>
                                        <span><?php echo number_format($tag->media_count);?> Posts</span>
                                    </a>
                                </div>
                            </article>
                            <?php }
                            if($array){
                            foreach($array as $arr){?>
                            <article>
                                <div class="card">
                                    <a href="<?php echo site_url("profile/?pid=".$arr->username);?>" target="_blank">
                                        <img src="<?php echo $arr->profile_picture;?>">
                                        <strong><?php echo $arr->full_name;?></strong>
                                        <br>
                                        <span>@<?php echo $arr->username;?></span>
                                    </a>
                                </div>
                            </article>
                            <?php 
                        }
                    }

                        ?>
                        </div>

                        <?php echo ($count==0)? 'No post found.':'';?>
                    </div>
                            <div class="left grid">
                                <article style="width: 100%;"><?php dynamic_sidebar('search-bottom');?> </article>
                            </div>

                   
                </div>
            </div>
        </div>
<?php get_footer();
