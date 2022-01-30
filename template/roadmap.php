<?php
function roadmap($args){
    ?>
    <section class="roadmap">
    <div class="container">
    <div class="roadmap__inner">
        <div class="roadmap__content">
            <?php
            foreach($args["cardlist"] as $value){
                if($value["id"] == $args["currentcard"]){
                    ?>
                    <h1 class="roadmap__content-title"><?php echo $value["name"] ?></h1>
                    <p class="roadmap__content-text"><?php echo $value["content"] ?></p>
                    <?php
                }
            }
            ?>
        </div>
        <div class="roadmap__sidebar">
            <?php
            foreach($args["cardlist"] as $value){
                ?><a href="<?php
                    echo SITE_PATH .
                    "roadmap?playlist=" . $_GET["playlist"] .
                    "&card=" . $value["id"]?>"
                    class="roadmap__sidebar-item">
                <div class="roadmap__sidebar-title"><?php echo $value["name"] ?></div>
                <div class="roadmap__sidebar-text"><?php echo substr($value["content"],0,100) . "..." ?></div>
                </a><?php
            }
            ?>
        </div>
        <div class="roadmap__burger"></div>
    </div>
    </div>
    </section>

    <script>
        let burger = document.querySelector('.roadmap__burger');
        let sidebar = document.querySelector('.roadmap__sidebar');

        if(document.documentElement.clientWidth >= 768){
            sidebar.style.display = 'block';
            burger.style.display = 'none';
            burger.style.rigth = '10px';
        } else {
            sidebar.style.display = 'none';
            burger.style.display = 'block';
            burger.innerText = 'Показать плейлист';
        }

        burger.onclick = (event) => {
            if(sidebar.style.display == 'none'){
                sidebar.style.display = 'block';
                burger.style.right = '260px';
                burger.innerText = 'Скрыть плейлист';
            } else {
                sidebar.style.display = 'none';
                burger.style.right = '10px';
                burger.innerText = 'Показать плейлист';
            }
        }

        window.onresize = (event) => {
            if(document.documentElement.clientWidth >= 768){
                sidebar.style.display = 'block';
                burger.style.display = 'none';
                burger.style.rigth = '10px';
                burger.innerText = 'Скрыть плейлист';
            } else {
                sidebar.style.display = 'none';
                burger.style.display = 'block';
                burger.innerText = 'Показать плейлист';
            }
        }
    </script>
    <?php
}
