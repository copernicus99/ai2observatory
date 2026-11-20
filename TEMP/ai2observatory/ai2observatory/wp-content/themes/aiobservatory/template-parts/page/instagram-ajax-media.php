<article>
                        <div class="card">
                            <a href="<?php echo site_url('media/?pid='.$post->id);?>" class="media" target="_blank">
                            <?php echo ($post->type=='video')? '<i class="icon-play"></i>':'';?>
                                <div class="pic picUrl" style="background-image:url('<?php echo $post->images->thumbnail->url;?>');"></div>
                            </a>
                            <section class="caption">
                                <small><?php echo human_time_diff( $post->created_time, current_time('timestamp') ) . ' ago'; ?></small>
                                <p>
                        <?php if($post->tags):?>
                                
                                <?php foreach($post->tags as $tag):?>
                                 <a href="<?php echo site_url('tag/?pid='.$tag);?>" title="<?php echo $tag;?>">#<?php echo $tag;?></a>
                            <?php endforeach;?>
                        <?php endif;?></p>
                            </section>
                            <footer class="clearfix">
                                <span>
                                    <i class="icon-like"></i>
                                    <?php echo $post->likes->count;?>
                                </span>
                                <span>
                                    <i class="icon-comment"></i>
                                    <?php echo $post->comments->count;?>
                                </span>
                                <span>
                                    <a href="#" class="share">
                                        <i class="icon-share"></i>
                                        Share
                                    </a>
                                </span>
                            </footer>
                        </div>
</article>