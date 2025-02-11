<?php
if (isset($_POST['valid'])) {
    header("location: ./autor-modif-quiz.php");
};
?><?php include '../component/header.php'; ?>

<main class="autor-quiz">

    <h1 class="title-quiz">Quiz : BLABLABLA</h1>
    <section class="new-question-update">
        <article class="new-question-update-card">
            <input type="text" class="new-question-update-input new-question" placeholder="Posez votre question"></input>
            <ul class="new-question-update-list">
                <input type="text" class="new-question-update-input new-answer" placeholder="Notez la réponse"></input>
                <input type="text" class="new-question-update-input new-answer" placeholder="Notez la réponse"></input>
                <input type="text" class="new-question-update-input new-answer" placeholder="Notez la réponse"></input>
                <input type="text" class="new-question-update-input new-answer" placeholder="Notez la réponse"></input>
            </ul>
            <div class="question-update-action">
                <form action="" method="post">
                    <input type="submit" name="valid" id="button" class="button valider button-center" value="Valider">
                </form>
            </div>
        </article>
    </section>

</main>
<?php include '../component/footer.php'; ?>