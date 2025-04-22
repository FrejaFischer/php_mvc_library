<?php include dirname(__DIR__) . '/Base/header.php'; ?>
<?php include dirname(__DIR__) . '/Base/nav.php'; ?>

    <main>
        <?php if (isset($validationErrors)): ?>
            <section class="validation_error">
                <?php foreach ($validationErrors as $error):?>
                    <p><?=$error ?> </p>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>
       <section>
            <form action="<?=\App\Config::BASE_URL?>books/create" method="POST" novalidate>
                <div>
                    <label for="txtTitle">Title</label>
                    <input type="text" name="title" id="txtTitle" value="<?=htmlspecialchars(trim($_POST['title'] ?? '')) ?>">
                </div>
                <div>
                    <label for="cmbAuthors">Author</label>
                    <select name="author" id="cmbAuthors">
                        <?php foreach ($authors as $author): ?>
                            <option value="<?=htmlspecialchars($author['author_id']) ?>"
                                <?=(int)($_POST['author'] ?? '') === (int)$author['author_id'] ? ' selected' : '' ?>>
                                <?=htmlspecialchars($author['first_name'] . 
                                    ' ' . $author['last_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="cmbPublisher">Publisher</label>
                    <select name="publisher" id="cmbPublisher">
                        <?php foreach ($publishers as $publisher): ?>
                            <option value="<?=htmlspecialchars($publisher['publisher_id']) ?>"
                                <?=(int)($_POST['publisher'] ?? '') === (int)$publisher['publisher_id'] ? ' selected' : '' ?>>
                                <?=htmlspecialchars($publisher['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="txtPublishingYear">Publishing year</label>
                    <input type="number" name="publishing_year" id="txtPublishingYear" pattern="\d{4}" value="<?=htmlspecialchars(trim($_POST['publishing_year'] ?? '')) ?>">
                </div>
                <div>
                    <button type="submit">Add book</button>
                </div>
            </form>
       </section>
    </main>
<?php include dirname(__DIR__) . '/Base/footer.php'; ?>