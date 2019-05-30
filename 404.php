<?php get_header(); ?>
    <div id="content">
        <div id="inner-content" class="wrap cf">
            <div id="main" class="m-all t-2of3 d-5of7 cf" role="main">
                <article id="post-not-found">
                    <div class="main-content-area">
                        <header class="article-header">
                            <h1><?php esc_html_e( 'Article Not Found', 'travel-notes' ); ?></h1>
                        </header> <?php // end article header ?>
                        <section class="entry-content cf" itemprop="articleBody">
                            <p><?php esc_html_e( 'The article you were looking for was not found. You may want to check your link or perhaps that page does not exist anymore.', 'travel-notes' ); ?></p>
                        </section>
                        <section class="search">
                            <p><?php get_search_form(); ?></p>
                        </section>
                        </div>
                </article> <?php // end article ?>              
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
<?php get_footer(); ?>