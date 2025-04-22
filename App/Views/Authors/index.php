<?php include dirname(__DIR__) . '/Base/header.php'; ?>
<?php include dirname(__DIR__) . '/Base/nav.php'; ?>
    <!-- <nav>
        <ul>
            <li>
                <a href="books/new" class="button">Add books</a>
            </li>
        </ul>
    </nav> -->
    <main>
        <section>
            <header>
                <h2>Author list</h2>
            </header>
            <?php foreach($authors as $author): ?>
                <article>
                    <header>
                        <h3><?=htmlspecialchars($author['first_name'] . ' ' . $author['last_name']); ?></h3>
                    </header>
                </article>
                <?php endforeach;?>
        </section>
    </main>
<?php include dirname(__DIR__) . '/Base/footer.php'; ?>