<?php
require_once 'helpers/Helper.php';
?>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td><?php echo $news['id']?></td>
    </tr>
    <tr>
        <th>Category name</th>
        <td><?php echo $news['category_name']?></td>
    </tr>
    <tr>
        <th>Title</th>
        <td><?php echo $news['title']?></td>
    </tr>
    <tr>
        <th>Avatar</th>
        <td>
            <?php if (!empty($news['avatar'])): ?>
                <img src="assets/uploads/<?php echo $news['avatar'] ?>" width="60"/>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <th>Seo Title</th>
        <td><?php echo $news['seo_title'] ?></td>
    </tr>
    <tr>
        <th>Seo description</th>
        <td><?php echo $news['seo_description'] ?></td>
    </tr>
    <tr>
        <th>Seo keywords</th>
        <td><?php echo $news['seo_keywords'] ?></td>
    </tr>
    <tr>
        <th>Status</th>
        <td><?php echo Helper::getStatusText($news['status']) ?></td>
    </tr>
    <tr>
        <th>Created at</th>
        <td><?php echo date('d-m-Y H:i:s', strtotime($news['created_at'])) ?></td>
    </tr>
    <tr>
        <th>Updated at</th>
        <td><?php echo !empty($news['updated_at']) ? date('d-m-Y H:i:s', strtotime($news['updated_at'])) : '--' ?></td>
    </tr>
</table>
<a href="index.php?controller=news&action=index" class="btn btn-default">Back</a>