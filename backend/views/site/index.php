<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Selamat Datang!</h1>

        <p class="lead">Kami siap membantu anda dalam mengawasi para pekerja selama jalannya proyek. Butuh bantuan atau ada pertanyaan? Kami siap membantu anda kapan saja. Hubungi kami segera.</p>

        <p><a class="btn btn-lg btn-success" href="mailto:admin@hadirbos.com">Kontak Kami</a></p>

    </div>

    <div class="body-content">
        <hr>
        <div class="row">
            <p class="lead" style="text-align: center;">
                <?php 
                    $introText = 'Anda terdaftar sebagai admin pada perusahaan dengan detail seperti berikut: ';
                    echo $introText;
                ?>
            </p>
        </div>

        <table class="table table-bordered">
            <tr>
                <td><p class="lead">Nama Perusahaan</p></td>
                <td><p class="lead">
                    <?php 
                        if (isset(Yii::$app->user->identity->company->name)) {
                            echo Yii::$app->user->identity->company->name;
                        } else {
                            echo '-';
                        }
                    ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td><p class="lead">Kode Perusahaan</p></td>
                <td><p class="lead">
                    <?php 
                        if (isset(Yii::$app->user->identity->company->code)) {
                            echo Yii::$app->user->identity->company->code;
                        } else {
                            echo '-';
                        }
                    ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td><p class="lead">Limit Proyek</p></td>
                <td><p class="lead">
                    <?php 
                        if (isset(Yii::$app->user->identity->company->companyLimitation->max_project)) {
                            echo Yii::$app->user->identity->company->companyLimitation->max_project;
                        } else {
                            echo '-';
                        }
                    ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td><p class="lead">Limit Karyawan</p></td>
                <td><p class="lead">
                    <?php 
                        if (isset(Yii::$app->user->identity->company->companyLimitation->max_user)) {
                            echo Yii::$app->user->identity->company->companyLimitation->max_user;
                        } else {
                            echo '-';
                        }
                    ?>
                    </p>
                </td>
            </tr>
        </table>

        <!-- <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div> -->

    </div>
</div>
