<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"/home/www/admin/localhost_9006/wwwroot/addons/loginvideo/view/background.html";i:1537100188;}*/ ?>
<?php if($config['background-video']): ?>
<div id="video_wrapper">
    <video autoplay muted loop>
        <source src="<?php echo $config['background-video']; ?>" type="video/mp4">
    </video>
</div>
<?php endif; ?>
<style>
    body {
        <?php if($config['background-color'] || $config['background-image']): ?>
            background:<?php echo $config['background-color']; if($config['background-image']): ?>url("<?php echo $config['background-image']; ?>")<?php endif; ?>;
        <?php endif; ?>
        background-size:cover;
    }
    <?php if($config['background-video']): ?>
    #video_wrapper {
        margin: 0px;
        padding: 0px;
    }

    #video_wrapper video {
        position: fixed;
        top: 50%;
        left: 50%;
        z-index: -100;
        min-width: 100%;
        min-height: 100%;
        width: auto;
        height: auto;
        transform: translate(-50%, -50%);
    }
    <?php endif; ?>
</style>