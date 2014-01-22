<h1>Blog posts</h1>

<?php foreach($posts as $post){ ?>
<p><?php echo $post['Post']['title']; ?> | <?php echo $post['Post']['created']; ?>

<?php } ?>
<?php unset($post); ?>