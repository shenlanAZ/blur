<?php $this->need('header.php'); ?>

<div class="material-layout  mdl-js-layout has-drawer is-upgraded">

    <main class="material-layout__content" id="main">
        <div id="top"></div>
        
        <!-- Floating Action Button -->
        <div class="back-step toTop" onclick='history.go(-1)'>
            <i class="material-icons footer_top-i">present_to_all</i>
        </div>

        <!-- Post module -->
        <div class="material-post_container">
            <div class="material-post mdl-grid">

                <!-- Article title -->
                <div class="mdl-card mdl-card-color mdl-shadow--4dp mdl-cell mdl-cell--12-col">
                    <div class="post_thumbnail-custom mdl-card__media mdl-color-text--grey-50" style="background-image: url(<?php echo showThumbnail($this); ?>);">
                        <p class="article-headline-p">
                            <?php $this->title() ?>
                        </p>
                    </div>

                    <!-- Article info -->
                    <div class="mdl-color-text--grey-700 mdl-card__supporting-text meta">
                        <!-- Author avatar -->
                        <div id="author-avatar">
                            <?php if (!empty($this->options->avatarURL)): ?>
                                <img src="<?php $this->options->avatarURL() ?>" width="44px" height="44px" alt="Author Avatar">
                            <?php else: ?>
                                <?php $this->author->gravatar(44); ?>
                            <?php endif; ?>
                        </div>

                        <div>
                            <!-- Author name -->
                            <strong><?php $this->author(); ?></strong>
                            <!-- Articel date -->
                            <span>
                            <?php if ($this->options->language != 'zh-CN'): ?>
                                <?php $this->date('F j, Y'); ?>
                            <?php else: ?>
                                <?php $this->dateWord(); ?>
                            <?php endif; ?>
                        </span>
                        </div>
                        <div class="section-spacer"></div>
                        <!-- view tags -->
                        <?php if (count($this->tags)): ?>
                        <button id="article-functions-viewtags-button" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                            <!-- For modern browsers. -->
                            <i class="material-icons" role="presentation">bookmarks</i>
                            <span class="visuallyhidden">tags</span>
                        </button>
                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="article-functions-viewtags-button">
                            <li class="mdl-menu__item">
                                <?php $this->tags('<li class="mdl-menu__item" style="text-decoration: none;"> ', true, ''); ?></li>
                        </ul>
                        <?php endif; ?>
                        <!-- share -->
                        <button id="article-fuctions-share-button" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
                            <i class="material-icons" role="presentation">share</i>
                            <span class="visuallyhidden">share</span>
                        </button>
                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="article-fuctions-share-button">
                            <?php if ($this->user->hasLogin()):?>
                                <a class="md-menu-list-a" href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid;?>" target="_blank">
                                    <li class="mdl-menu__item">编辑</li>
                                </a>
                            <?php endif;?>
                            <a class="md-menu-list-a" href="">
                                <li class="mdl-menu__item">
                                <?php lang("share.toImg") ?>
                                </li>
                            </a>
                        </ul>
                    </div>

                    <!-- Articel content -->
                    <div id="post-content" class="mdl-color-text--grey-700 mdl-card__supporting-text fade out">
                        <?php
                        if (!empty($this->options->switch) && in_array('PanguPHP', $this->options->switch)) {
                            print pangu($this->content);
                        } else {
                            $this->content(); 
                        }
                        ?>
                        <?php if ($this->options->post_license_cc == "cc4"): ?>
                            <blockquote style="margin: 2em 0 0;padding: 0.5em 1em;border-left: 3px solid #F44336;background-color: #F5F5F5;list-style: none;">
                                <p>
                                    <strong><?php lang("post.permalink"); echo "<a href=\"" . $this->permalink . "\">" . $this->permalink . "</a>" ;?></strong><br>
                                    <strong>This blog is under a <a href="https://creativecommons.org/licenses/by-nc-sa/4.0/" target="_blank">CC BY-NC-SA 4.0 Unported License</a></strong>
                                </p>
                            </blockquote>
                        <?php elseif ($this->options->post_license_cc == "cc3"): ?>
                            <blockquote style="margin: 2em 0 0;padding: 0.5em 1em;border-left: 3px solid #F44336;background-color: #F5F5F5;list-style: none;">
                                <p>
                                    <strong><?php lang("post.permalink"); echo "<a href=\"" . $this->permalink . "\">" . $this->permalink . "</a>" ;?></strong><br>
                                    <strong>This blog is under a <a href="https://creativecommons.org/licenses/by-nc-sa/3.0/" target="_blank">CC BY-NC-SA 3.0 Unported License</a></strong>
                                </p>
                            </blockquote>
                        <?php elseif (!empty($this->options->post_license)): ?>
                            <blockquote style="margin: 2em 0 0;padding: 0.5em 1em;border-left: 3px solid #F44336;background-color: #F5F5F5;list-style: none;">
                                <p>
                                    <strong><?php lang("post.permalink"); echo "<a href=\"" . $this->permalink . "\">" . $this->permalink . "</a>" ;?></strong><br>
                                    <strong><?php $this->options->post_license(); ?></strong>
                                </p>
                            </blockquote>
                        <?php endif;?>
                    </div>

                    <!-- Article comments -->
                    <?php include('comments.php'); ?>

                </div>

                <!-- theNext thePrev button -->
                <nav class="material-nav mdl-color-text--grey-50 mdl-cell mdl-cell--12-col">
                    <?php $this->theNext('%s', null, array('title' => '
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon mdl-color--white mdl-color-text--grey-900" role="presentation">
                            <i class="material-icons">arrow_back</i>
                        </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . lang("post.newer", false) . '', 'tagClass' => 'prev-content')); ?>
                    <div class="section-spacer"></div>
                    <?php $this->thePrev('%s', null, array('title' =>  lang("post.older", false) . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon mdl-color--white mdl-color-text--grey-900" role="presentation">
                            <i class="material-icons">arrow_forward</i>
                        </button>', 'tagClass' => 'prev-content')); ?>
                </nav>
            </div>

            <?php //include('sidebar.php'); ?>
            <?php include('footer.php'); ?>
