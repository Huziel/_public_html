<?php
class app
{
    public function getUsers()
    {
        $content = file_get_contents("https://pokeapi.co/api/v2/pokemon/?offset=0&limit=150");

        $result  = json_decode($content);

        $rs = $result;

?>
        <div class="table-responsive">
            <table class="table table-sm table-striped">
                <thead class="table-dark">
                    <tr>

                        <th>Nombre</th>


                        <th>Herramientas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($rs->results as $pokemon) {
                    ?>
                        <tr>

                            <td>
                                <?= $pokemon->name ?>
                            </td>

                            <td>
                                <div class="row">
                                    <div class="col-12">
                                        <center>
                                            <button type="button" class="btn btn-dark" onclick="viewDetails('<?= $pokemon->url ?>')">Detalles</button>
                                        </center>
                                    </div>

                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <?php


        /* var_dump($result); */


    }
    public function getDetailsUser($id)
    {
        $content = file_get_contents("$id");

        $result  = json_decode($content);

        $rs = $result;
        foreach ($rs->forms as $pokemon) {
        ?>
            <center>
                <div class="col-6 divCard">

                    <h1><?= $pokemon->name ?></h1>
                    <br>

                </div>
            </center>
        <?php
        }

        ?>
        <center>
            <div class="col-6 divCard">
                <img src=" <?= $rs->sprites->other->dream_world->front_default ?>" class="img-fluid rounded-top" alt="">

                <br>

            </div>
        </center>
        <?php

        ?>
        <center>
            <h2>Movimientos</h2>
        </center>
        <div class="row">
            <?php
            foreach ($rs->moves as $pokemon) {
            ?>

                <div class="col-6 divCard">

                    <i class="fas fa-running"></i> <?= $pokemon->move->name ?>
                    <br>

                </div>

            <?php
            }
            ?>
        </div>
        <br>
        <center>
            <h2>Habilidades</h2>
        </center>
        <div class="row">
            <?php
            foreach ($rs->abilities as $pokemon) {

            ?>




                <div class="col-6 divCard">

                    <i class="fas fa-bolt"></i> <?= $pokemon->ability->name ?>

                </div>


            <?php
            }
            ?>
        </div>
        <br>
        <center>
            <h2>Estadisticas</h2>
        </center>
        <div class="row">
            <?php
            foreach ($rs->stats as $pokemon) {

            ?>




                <div class="col-6 divCard">

                    <i class="fas fa-wave-square"></i> <?= $pokemon->base_stat ?> <?= $pokemon->stat->name ?>

                </div>


            <?php
            }
            ?>
        </div>

<?php
    }
}
