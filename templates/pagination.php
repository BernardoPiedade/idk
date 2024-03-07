<nav class="mt-4" aria-label="Page navigation">
    <ul class="pagination">
    <!--- Prev --->
    <?php if ($page_num > 1) : ?>
        <li class="page-item"><a class="page-link" <?php echo "href=?page_num=$previous_page"; ?>>Prev</a></li>
    <?php endif ?>
    <!--- Next --->
    <?php if ($page_num < $total_num_of_pages) : ?>
        <li class="page-item"><a class="page-link" <?php echo "href=?page_num=$next_page"; ?>>Next</a></li>
    <?php endif ?>
    </ul>
</nav>