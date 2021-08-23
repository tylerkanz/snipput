<?php
add_shortcode('snipputs', 'snipput_func');

function snipput_func()
{
global $wpdb;
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/prism.min.js" integrity="sha512-axJX7DJduStuBB8ePC8ryGzacZPr3rdLaIDZitiEgWWk2gsXxEFlm4UW0iNzj2h3wp5mOylgHAzBzM4nRSvTZA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.24.1/themes/prism-okaidia.min.css" integrity="sha512-mIs9kKbaw6JZFfSuo+MovjU+Ntggfoj8RwAmJbVXQ5mkAX5LlgETQEweFPI18humSPHymTb5iikEOKWF7I8ncQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="container">

    <div class="row">
        <div class="col-md-6 p-4 mx-auto mt-4">
            <h1>Snipputs</h1>
        </div>
    </div>

    <?php
    global $post;
    $args = array( 'numberposts' => 30, 'category_name' => 'snipputs' );
    $posts = get_posts( $args );
    foreach( $posts as $post ): setup_postdata($post); 
    $snipput_user = get_user_by('ID', $post->post_author);
    ?>
        <div class="row">
            <div class="col-6 border border-secondary rounded p-4 mx-auto">
                <div class="row d-flex align-items-center">
                    <div class="col-auto">
                        <img src="<?php echo get_avatar_url( $snipput_user->ID );?>" class="rounded-circle border">
                    </div>
                    <div class="col-auto">
                        <h4><?php echo $snipput_user->first_name . ' ' . $snipput_user->last_name; ?></h4>
                    </div>
                    <div class="col-auto ml-auto">
                        <p class="text-right mb-0"><?php echo date("F j, Y, g:i a", strtotime($post->post_date)); ?></p>
                    </div>
                </div>
                <hr class="w-100">
                <div class="row">
                    <div class="col-lg-12">
                        <p><?php echo $post->post_title;?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <pre><code class="language-<?php echo get_post_meta($post->ID, 'meta-box-dropdown', true)?>"><?php echo htmlspecialchars($post->post_content);?></code></pre>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php
}
?>