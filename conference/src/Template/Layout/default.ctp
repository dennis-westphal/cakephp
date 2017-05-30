<!DOCTYPE HTML>
<!--
	Phantom by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
    <title>conference: <?= $this->fetch('title') ?></title>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><?= $this->Html->script('ie/html5shiv.js') ?><![endif]-->
    <?= $this->Html->css('main.css') ?>
    <!--[if lte IE 9]><?= $this->Html->css('ie9.css') ?><![endif]-->
    <!--[if lte IE 8]><?= $this->Html->css('ie8.css') ?><![endif]-->
    <?= $this->Html->css('custom.css') ?>
    <?= $this->Html->css('jquery-ui.min.css') ?>

    <?= $this->Html->meta('icon') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<!-- Wrapper -->
<div id="wrapper">

    <!-- Header -->
    <header id="header">
        <div class="inner">

            <!-- Logo -->
            <a href="<?= $this->Url->build(['controller' => 'topics', 'action' => 'index']) ?>" class="logo">
                <span class="symbol"><?= $this->Html->image('logo.svg') ?></span><span class="title">cakePHP conference</span>
            </a>

            <!-- Nav -->
            <nav>
                <ul>
                    <li><?= $this->Html->link('Topics', ['controller' => 'topics']) ?></li>
                    <?php if($userType === 'author'): ?>
                    <li><?= $this->Html->link('Your Topics', ['controller' => 'topics', 'action' => 'author', $userId]) ?></li>
                    <?php endif; ?>
                    <?php if($userType === 'guest'): ?>
                        <li><?= $this->Html->link('Login', ['controller' => 'users', 'action' => 'login']) ?></li>
                    <?php else: ?>
                        <li><?= $this->Html->link('Logout', ['controller' => 'users', 'action' => 'logout']) ?></li>
                    <?php endif; ?>
                    <li><a href="#menu">Menu</a></li>
                </ul>
            </nav>

        </div>
    </header>

    <!-- Menu -->
    <nav id="menu">
        <h2>Menu</h2>
        <ul>
            <li><?= $this->Html->link('Topics', ['controller' => 'topics']) ?></li>
            <?php if($userType === 'author'): ?>
                <li><?= $this->Html->link('Your Topics', ['controller' => 'topics', 'action' => 'author', $userId]) ?></li>
            <?php endif; ?>
            <?php if($userType === 'guest'): ?>
                <li><?= $this->Html->link('Login', ['controller' => 'users', 'action' => 'login']) ?></li>
            <?php else: ?>
                <li><?= $this->Html->link('Logout', ['controller' => 'users', 'action' => 'logout']) ?></li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- Main -->
    <div id="main">
        <div class="inner">
            <div class="flash">
                <?= $this->Flash->render() ?>
            </div>

            <?= $this->fetch('content') ?>
        </div>
    </div>

    <!-- Footer -->
    <footer id="footer">
        <div class="inner">
            <ul class="copyright">
                <li>&copy; Dennis Westphal. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
            </ul>
        </div>
    </footer>

</div>

<!-- Scripts -->
<?= $this->Html->script('jquery.min.js') ?>
<?= $this->Html->script('jquery-ui.min.js') ?>
<?= $this->Html->script('skel.min.js') ?>
<?= $this->Html->script('util.js') ?>
<!--[if lte IE 8]><?= $this->Html->script('ie/respond.min.js') ?></script><![endif]-->
<?= $this->Html->script('main.js') ?>
<?= $this->fetch('scriptBottom') ?>
</body>
</html>
