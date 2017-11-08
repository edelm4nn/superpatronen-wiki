<?php $tuto_options = tuto_theme_options(); ?>
<?php get_header(); ?>
<div class="mh-wrapper clearfix">
	<div id="main-content" class="mh-content-fluid"><?php
		tuto_before_page_content();
		if (have_posts()) { ?>
            <header class="page-header"><?php
            echo '<h1 class="page-title mh-page-title">' . get_the_archive_title() . '</h1>';
				if (is_author()) {
					tuto_author_box();
				} else {
					the_archive_description('<div class="mh-loop-description">', '</div>');
				} ?>
            </header><?php
                                
            $post_array = array();
            $counter = 0;
            while (have_posts()) : the_post();
                
                $post_title = get_the_title();
                $post_link = get_the_permalink();
                $first_letter = strtoupper($post_title[0]);

                if (!isset($post_array[$first_letter])) {
                    $post_array[$first_letter] = array(
                        $post_title => $post_link,
                    );
                } else {
                    $current_stack = array($post_title => $post_link);
                    $old_stack = $post_array[$first_letter];
                    $new_stack = $old_stack + $current_stack;
                    $post_array[$first_letter] = $new_stack;
                }
                $counter ++;
            endwhile;

            if(count($post_array) != 0) { ?>
                <div class="mh-glossary">
                <?php foreach ($post_array as $key => $post_collection) { ?>
                    <div class="glossary glossary-unit-<?php echo $key; ?>">
                    <div class="glossary-title"><h2><?php echo strtoupper($key); ?></h2></div>
                    <div class="glossary-units">
                        <ul class="glossary-list">
                            <?php foreach ($post_collection as $post_title => $post_link) { ?>
                                <li><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    </div>
              <?php } ?>
               </div>
               <?php  }
		} else {
			get_template_part('content', 'none');
		} ?>
	</div>
</div>
<?php get_footer(); ?>