<?php
    defined( 'ABSPATH' ) || die;

    /**
     * WYSIWYG render
     * 
     * Styled content with TailwindCSS
     */

    $content = $args['content'];

    if( $content ):
?>
    
    <div class="wysiwyg">
        <?= $content ?>
    </div>

<?php endif; ?>
