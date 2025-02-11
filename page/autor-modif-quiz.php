<?php
if (isset($_POST['update'])) {
    header("location: ./autor-modif-question.php");
};
if (isset($_POST['new-question'])) {
    header("location: ./autor-new-question.php");
};

?>

<?php include '../component/header.php'; ?>
<main class="autor-quiz">
    <div class="update-quiz">
        <?php if (isset($_POST['update-name'])) : ?>
            <form action="" method="post" class="form-update-name">
                <div class="form-new-name">
                    <input type="text" name="new-name" class="new-name" placeholder="le nom du quiz">
                    <input type="submit" name="update-new-name" id="button" class="button valider button-center" value="valider">
                </div>
            </form>
        <?php else : ?>
            <h1 class="title-quiz">Quiz : BLABLABLA</h1>
            <form action="" method="post">
                <input type="submit" name="update-name" id="button" class="button valider" value="Modifier">
            </form>
            <form action="" method="post">
                <input type="submit" name="delete-quiz" id="button" class="button delete" value="supprimer">
            </form>
        <?php endif ?>
    </div>
    <section class="question">
        <article class="question-card">
            <h2 class="question-card-title">Question ?</h2>
            <ul>
                <li class="question-answer">Reponse 1</li>
                <li class="question-answer">Reponse 2</li>
                <li class="question-answer">Reponse 3</li>
                <li class="question-answer">Reponse 4</li>
            </ul>
            <div class="question-action">
                <form action="" method="post">
                    <input type="submit" name="update" id="button" class="button valider button-center" value="Modifier">
                </form>
                <form action="" method="post">
                    <input type="submit" name="delete" id="button" class="button delete button-center" value="Supprimer">
                </form>
            </div>
        </article>
        <article class="question-card">
            <h2 class="question-card-title">Question ?</h2>
            <ul>
                <li class="question-answer">Reponse 1</li>
                <li class="question-answer">Reponse 2</li>
                <li class="question-answer">Reponse 3</li>
                <li class="question-answer">Reponse 4</li>
            </ul>
            <div class="question-action">
                <form action="" method="post">
                    <input type="submit" name="update" id="button" class="button valider button-center" value="Modifier">
                </form>
                <form action="" method="post">
                    <input type="submit" name="delete" id="button" class="button delete button-center" value="Supprimer">
                </form>
            </div>
        </article>
        <article class="question-card">
            <h2 class="question-card-title">Question ?</h2>
            <ul>
                <li class="question-answer">Reponse 1</li>
                <li class="question-answer">Reponse 2</li>
                <li class="question-answer">Reponse 3</li>
                <li class="question-answer">Reponse 4</li>
            </ul>
            <div class="question-action">
                <form action="" method="post">
                    <input type="submit" name="update" id="button" class="button valider button-center" value="Modifier">
                </form>
                <form action="" method="post">
                    <input type="submit" name="delete" id="button" class="button delete button-center" value="Supprimer">
                </form>
            </div>
        </article>
        <article class="question-card">
            <h2 class="question-card-title">Question ?</h2>
            <ul>
                <li class="question-answer">Contre Freezer</li>
                <li class="question-answer">Reponse 2</li>
                <li class="question-answer">Reponse 3</li>
                <li class="question-answer">Reponse 4</li>
            </ul>
            <div class="question-action">
                <form action="" method="post">
                    <input type="submit" name="update" id="button" class="button valider button-center" value="Modifier">
                </form>
                <form action="" method="post">
                    <input type="submit" name="delete" id="button" class="button delete button-center" value="Supprimer">
                </form>
            </div>
        </article>
        <article class="question-card">
            <h2 class="question-card-title">Question ?</h2>
            <ul class="question-answer-list">
                <li class="question-answer">Déclarer la guerre au monde vsbjhvqcvhjfffffffffff</li>
                <li class="question-answer">Déclarer la guerre au monde vsbjhvqcvhjfffffffffff</li>
                <li class="question-answer">Déclarer la guerre au monde vsbjhvqcvhjfffffffffff</li>
                <li class="question-answer">Déclarer la guerre au monde vsbjhvqcvhjfffffffffff</li>
            </ul>
            <div class="question-action">
                <form action="" method="post">
                    <input type="submit" name="update" id="button" class="button valider button-center" value="Modifier">
                </form>
                <form action="" method="post">
                    <input type="submit" name="delete" id="button" class="button delete button-center" value="Supprimer">
                </form>
            </div>
        </article>
        <article class="question-card">
            <h2 class="question-card-title">Question ?</h2>
            <ul>
                <li class="question-answer">Reponse 1</li>
                <li class="question-answer">Reponse 2</li>
                <li class="question-answer">Reponse 3</li>
                <li class="question-answer">Reponse 4</li>
            </ul>
            <div class="question-action">
                <form action="" method="post">
                    <input type="submit" name="update" id="button" class="button valider button-center" value="Modifier">
                </form>
                <form action="" method="post">
                    <input type="submit" name="delete" id="button" class="button delete button-center" value="Supprimer">
                </form>
            </div>
        </article>
    </section>
    <form action="" method="post">
        <input type="submit" name="new-question" id="button" class="button-new valider" value="Nouvelle Question">
    </form>



</main>
<?php include '../component/footer.php'; ?>