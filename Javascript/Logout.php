<script>
document.addEventListener('DOMContentLoaded', function() {
var link = document.querySelector('.change-text');

link.addEventListener('mouseenter', function() {
this.innerText = 'Logout';
});

link.addEventListener('mouseleave', function() {
this.innerText = 'Login:<?php echo getUsername(); ?>';
});
});
</script>
