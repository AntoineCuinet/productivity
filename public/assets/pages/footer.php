<!-- btn pour remonter en haut du site -->
<div class="to-top-btn">
    <img src="../pictures/arrow-down-circle-outline.svg" alt="Remonter" width="50px" height="50px">
</div>

<?php if ($currentScript === 'dashboard.php' || $currentScript === '404.php' || $currentScript === 'cookies.php' || $currentScript === 'mentions.php'): ?>
<footer>
    <hr class="copyright-hr">
    <br>
    <div class="copyright">
        <p><?= $title; ?> © 2024</p>
    </div>
    <br>
</footer>
<?php endif; ?>

<!-- script.js -->
<script src="../../script.js"></script>
</body>
</html>
