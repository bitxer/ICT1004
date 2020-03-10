<nav aria-label="BlogNav">
    <ul class="pagination justify-content-end">
        <li class="page-item <?= ($data['blog_current_page']==1) ? "disabled" : "" ?>">
            <a class="page-link" href="<?=parse_url($_SERVER['REQUEST_URI'])['path'];?>?page=<?= $data['blog_current_page']>=1 ? $data['blog_current_page']-1 : 1?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <?php for($page=1;$page<=$data['blog_max_page'];$page++) : ?>
            <li class="page-item <?= $page==$data['blog_current_page'] ? "active" : "" ?>"><a class="page-link" href="<?=parse_url($_SERVER['REQUEST_URI'])['path'];?>?page=<?=$page;?>"><?=$page;?></a></li>
        <?php endfor;?>
        ?>
        <li class="page-item <?= $data['blog_current_page']==$data['blog_max_page'] ? "disabled" : "" ?>">
            <a class="page-link" href="<?=parse_url($_SERVER['REQUEST_URI'])['path'];?>?page=<?= $data['blog_current_page']>=1 ? $data['blog_current_page']+1 : $data['blog_max_page']?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>