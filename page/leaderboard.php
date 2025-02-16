<?php

session_start();

include_once('../models/User.php');

$newUser = new Utilisateur();
$infoUser = $newUser->get_userInfo();
$eliminatedUser = $newUser->get_userEliminated();

?>

<?php include '../component/header.php'; ?>


<main class="main-james">
    <!-- prochaines victimes -->
    <div class="leaderboard-content-box">
        <?php if (!isset($_GET['eliminated'])): ?>

            <div class="button-box">
                <form action="" method="get" class="button-box-leaderboard">
                    <input type="submit" name="eliminated" id="next" class="button-lead button-next-red" value="Joueurs éliminés">
                </form>
            </div>



            <div class="title-james">
                <h1 class="quiz-title">Prochaines victimes</h1>
                <hr class="separator">
            </div>


            <div class="dollsAdd">
                <div class="doll-left">
                    <img src="../asset/img/dollv2.png" />
                </div>



                <section class="leaderboard-tab">

                    <table class="leaderBox">
                        <thead>
                            <tr>
                                <th class="int-tab"># joueur</th>
                                <th class="title-tab">pseudo</th>
                                <th class="int-tab">score</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($infoUser as $value) : ?>
                                <?php if ($value['score'] != 0) : ?>
                                    <tr>
                                        <td class="user-number">{ <?= $newUser->changeNumber($value['id']) ?> }</td>
                                        <td class="user-pseudo"><?= $value['pseudo'] ?></td>
                                        <td class="user-score"><?= $value['score'] ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </section>

                <div class="doll-right">
                    <img src="../asset/img/dollv2.png" />
                </div>
            </div>
            <!-- joueurs éliminés -->
        <?php else: ?>
            <section class="button-leaderboard">
                <div class="button-box">
                    <form action="" method="get" class="button-box-leaderboard">
                        <input type="submit" name="stillAlive" id="next" class="button-lead button-next-green" value="Prochaines Victimes">
                    </form>
                </div>
            </section>

            <div class="title-james">
                <h1 class="quiz-title">Joueurs éliminés</h1>
                <?php ?>
                <p>Total: <?= count($eliminatedUser) ?></p>
                <hr class="separator">
            </div>

            <div class="dollsAdd">
                <div class="doll-left">
                    <img src="../asset/img/dollv2.png" />
                </div>

                <section class="leaderboard-tab">

                    <table class="leaderBox">
                        <thead>
                            <tr>
                                <th class="int-tab"># joueur</th>
                                <th class="title-tab">pseudo</th>
                                <th class="int-tab">score</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php foreach ($eliminatedUser as $value) : ?>

                                <tr>
                                    <td class="user-number">{ <?= $newUser->changeNumber($value['id']) ?> }</td>
                                    <td class="user-pseudo"><?= $value['pseudo'] ?></td>
                                    <td class="user-score text-pink">Eliminé</td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </section>
                <div class="doll-right">
                    <img src="../asset/img/dollv2.png" />
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include '../component/footer.php'; ?>