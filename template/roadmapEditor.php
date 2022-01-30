<?php
function roadmapEditor(){
?>
<section class="roadmap-editor">
<div class="container">
<div class="roadmap-editor__inner">
    <div class="roadmap-editor__playlists">
        <div class="roadmap-editor__playlists-list">
            <?php
            global $dbconn;
    		$sql = 'SELECT id, name FROM playlists';
    		$result = pg_query($dbconn, $sql);
    		while ($row = pg_fetch_row($result)) {
    			?>
                <div class="roadmap-editor__playlists-list-item" data-select="false" data-id="<?php echo $row[0];?>">
                    <?php
                    echo $row[1];
                    ?>
                </div>
                <?php
    		}
            ?>
        </div>
        <div class="roadmap-editor__playlists-buttons">
            <div class="text-area" contenteditable="true">введите текст</div>
            <div class="add button">Добавить плейлист</div>
            <div class="delete button">Удалить плейлист</div>
        </div>
    </div>
    <div class="roadmap-editor__currentcard">
        <div class="buttons">
            <div class="save button">Сохранить карточку</div>
        </div>
        <div class="name" contenteditable="true"></div>
        <div class="content" contenteditable="true"></div>
    </div>
    <div class="roadmap-editor__cards">
        <div class="roadmap-editor__cards-list"></div>
        <div class="roadmap-editor__cards-buttons">
            <div class="text-area" contenteditable="true">введите текст</div>
            <div class="add button">Добавить карточку</div>
            <div class="delete button">Удалить карточку</div>
        </div>
    </div>
</div>
</div>
</section>

<script>

let playlist = document.querySelector('.roadmap-editor__playlists-list');
let playlistsText = document.querySelector('.roadmap-editor__playlists-buttons .text-area');
let playlistsAdd = document.querySelector('.roadmap-editor__playlists-buttons .add');
let playlistsDelete = document.querySelector('.roadmap-editor__playlists-buttons .delete');

let cardName = document.querySelector('.roadmap-editor__currentcard .name');
let cardContent = document.querySelector('.roadmap-editor__currentcard .content');
let cardSave = document.querySelector('.roadmap-editor__currentcard .buttons .save');

let cardlist = document.querySelector('.roadmap-editor__cards-list');
let textCard = document.querySelector('.roadmap-editor__cards-buttons .text-area');
let addCard = document.querySelector('.roadmap-editor__cards-buttons .add');
let deleteCard = document.querySelector('.roadmap-editor__cards-buttons .delete');

let idCard;
let targetCurrent = null;
let targetCurrent2 = null;

//нажатие на плейлист из списка плейлистов
playlist.onclick = (event) => {
    if(event.target.className == "roadmap-editor__playlists-list-item"){
        if(targetCurrent != null){
            targetCurrent.style.backgroundColor = '#f0f0f0';
            targetCurrent.setAttribute('data-select', 'false');
        }
        targetCurrent = event.target;
        targetCurrent.style.backgroundColor = '#e0ba8a';
        targetCurrent.setAttribute('data-select', 'true');


        fetch('/script/getCardlist.php',{
			method: 'POST',
                body: JSON.stringify({id: targetCurrent.getAttribute('data-id')}),
			headers: {
      			'Content-Type': 'application/json;charset=utf-8'
    		},
		})
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            cardlist.innerHTML = '';
            //проверяем есть ли посты в списке
            if(isEmpty(data) == false){
                for(let item in data){
                    //добавляем полученные посты в список постов
                    let aaa = data[item];
                    cardlist.innerHTML += '<div class="list-item" data-select="false" data-id="'+ aaa["id"] +'">' + aaa["name"] + '</div>';
                }
            } else {
                //выводим надпись что постов нет
                cardlist.innerHTML = 'постов нет';
            }
        });
    }
}


//нажатие на кнопку "добавить плейлист"
playlistsAdd.onclick = (event) => {
    fetch('/script/addPlaylist.php',{
		method: 'POST',
            body: JSON.stringify({name: playlistsText.innerText}),
		headers: {
  			'Content-Type': 'application/json;charset=utf-8'
		},
	}).then(() => {
        fetch('/script/getPlaylist.php')
        .then((response) => {
			return response.json();
		})
        .then((data) => {
            playlist.innerHTML = '';
			//проверяем есть ли посты в списке
			if(isEmpty(data) == false){
				for(let item in data){
					//добавляем полученные посты в список постов
                    let aaa = data[item];
	                playlist.innerHTML += `<div class="list-item"
                                            data-select="false"
                                            data-id="`+ aaa[0] +`">` +
					                        aaa[1] + `</div>`;
				}
			} else {
				//выводим надпись что постов нет
				playlist.innerHTML = 'постов нет';
			}
		});
    });
}


//нажатие на кнопку "удалить плейлист"
playlistsDelete.onclick = (event) => {
    fetch('/script/deletePlaylist.php',{
		method: 'POST',
            body: JSON.stringify({id: targetCurrent.getAttribute('data-id')}),
		headers: {
  			'Content-Type': 'application/json;charset=utf-8'
		},
	}).then(() => {
        fetch('/script/getPlaylist.php')
        .then((response) => {
			return response.json();
		})
        .then((data) => {
            playlist.innerHTML = '';
			//проверяем есть ли посты в списке
			if(isEmpty(data) == false){
                for(let item in data){
					//добавляем полученные посты в список постов
                    let aaa = data[item];
	                playlist.innerHTML += `<div class="list-item"
                                            data-select="false"
                                            data-id="`+ aaa[0] +`">` +
					                        aaa[1] + `</div>`;
				}
			} else {
				//выводим надпись что постов нет
				playlist.innerHTML = 'постов нет';
			}
            cardlist.innerHTML = '';
		});
    });
}


addCard.onclick = (event) => {
    fetch('/script/addCard.php',{
		method: 'POST',
            body: JSON.stringify({name: textCard.innerText,playlistId: targetCurrent.getAttribute('data-id')}),
		headers: {
  			'Content-Type': 'application/json;charset=utf-8'
		},
	}).then(() => {
        fetch('/script/getCardlist.php',{
			method: 'POST',
                body: JSON.stringify({id: targetCurrent.getAttribute('data-id')}),
			headers: {
      			'Content-Type': 'application/json;charset=utf-8'
    		},
		})
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            cardlist.innerHTML = '';
            //проверяем есть ли посты в списке
            if(isEmpty(data) == false){
                for(let item in data){
                    //добавляем полученные посты в список постов
                    let aaa = data[item];
                    cardlist.innerHTML += '<div class="list-item" data-select="false" data-id="'+ aaa["id"] +'">' + aaa["name"] + '</div>';
                }
            } else {
                //выводим надпись что постов нет
                cardlist.innerHTML = 'постов нет';
            }
        });
    });
}




deleteCard.onclick = (event) => {
    fetch('/script/deleteCard.php',{
        method: 'POST',
        body: JSON.stringify({id1: targetCurrent2.getAttribute('data-id'),
                              id2: targetCurrent.getAttribute('data-id')}),
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
    }).then(() => {
        fetch('/script/getCardlist.php',{
			method: 'POST',
                body: JSON.stringify({id: targetCurrent.getAttribute('data-id')}),
			headers: {
      			'Content-Type': 'application/json;charset=utf-8'
    		},
		})
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            cardlist.innerHTML = '';
            cardName.innerHTML = '';
            cardContent.innerHTML = '';
            //проверяем есть ли посты в списке
            if(isEmpty(data) == false){
                for(let item in data){
                    //добавляем полученные посты в список постов
                    let aaa = data[item];
                    cardlist.innerHTML += '<div class="list-item" data-select="false" data-id="'+ aaa["id"] +'">' + aaa["name"] + '</div>';
                }
            } else {
                //выводим надпись что постов нет
                cardlist.innerHTML = 'постов нет';
            }
        });
    });
}

//нажатие на карточку из списка карточек
cardlist.onclick = (event) => {
    if(event.target.className == "list-item"){
        if(targetCurrent2 != null){
            targetCurrent2.style.backgroundColor = '#f0f0f0';
            targetCurrent2.setAttribute('data-select', 'false');
        }
        targetCurrent2 = event.target;
        targetCurrent2.style.backgroundColor = '#e0ba8a';
        targetCurrent2.setAttribute('data-select', 'true');


        fetch('/script/getCard.php',{
			method: 'POST',
                body: JSON.stringify({name: targetCurrent2.innerText}),
			headers: {
      			'Content-Type': 'application/json;charset=utf-8'
    		},
		})
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            cardContent.innerHTML = '';
            cardName.innerHTML = '';
            //проверяем есть ли посты в списке
            if(isEmpty(data) == false){
                /*let arr = data[0].split(',');
                for(let item in arr){*/
                    //добавляем полученные посты в список постов
                    /*cardName.innerHTML = data[0];
                    cardContent.innerHTML = data[1];*/
                    cardName.innerText = data[0];
                    cardContent.innerText = data[1];
                    idCard = data[2];
                /*}*/
            }
        });
    }
}

//нажатие на кнопку "сохранить карточку"
cardSave.onclick = (event) => {
    fetch('/script/saveCard.php',{
        method: 'POST',
            body: JSON.stringify({name: cardName.innerText,
                                  content: cardContent.innerText,
                                  id: idCard}),
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
    })
    .then(() => {
        fetch('/script/getCardlist.php',{
            method: 'POST',
                body: JSON.stringify({id: targetCurrent.getAttribute('data-id')}),
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
        })
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            cardlist.innerHTML = '';
            //проверяем есть ли посты в списке
            if(isEmpty(data) == false){
                for(let item in data){
                    //добавляем полученные посты в список постов
                    let aaa = data[item];
                    cardlist.innerHTML += '<div class="list-item" data-select="false" data-id="'+ aaa["id"] +'">' + aaa["name"] + '</div>';
                }
            } else {
                //выводим надпись что постов нет
                cardlist.innerHTML = 'постов нет';
            }
        })
    });
}
</script>
<?php
}
