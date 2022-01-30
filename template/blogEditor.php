<?php
function blogEditor(){
?>
<section class="blog-editor">
<div class="container">
<div class="blog-editor__inner">
<div class="text-editor" contenteditable="true">
</div>
<div class="buttons">
	<div class="but5">открыть</div>
	<div class="but6">сохранить</div>
	<div class="but7">создать</div>
	<div class="but8">удалить</div>
</div>

<div class="open-post">
	<div class="posts"></div>
	<div class="no-post">
		Постов нет
	</div>
	<div class="close">Закрыть</div>
</div>
<div class="enter-name">
    <div class="text-name" contenteditable="true">text</div>
	<div class="create-name">Создать</div>
    <div class="close-name">Закрыть</div>
</div>
</div>
</div>
</section>
<script type="text/javascript">
	"use strict";
	/*
	вставляет одну строку в другую
	str1 - строка в которую вставляем
	str2 - строка которую вставляем
	num - место куда вставляем
	*/
	function insertStr(str1, str2, num){
		return str1.slice(0, num) + str2 + str1.slice(num);
	}

	/*
	ищет у блока родителя с подходящим названием класса
	(проверяет есть ли он)
	node - блок
	nodeClassName - название класса
	*/
	function findParentNode(node, nodeClassName){
		while(node.className != nodeClassName){
			if(node.nodeName == 'BODY') return false;
			node = node.parentNode;
		}
		return true;
	}

    /*
	ищет у блока родителя с подходящим названием класса
	node - блок
	nodeClassName - название класса
	*/
	function findParentNode2(node, nodeClassName){
		while(node.className != nodeClassName){
			if(node.nodeName == 'BODY') return false;
			node = node.parentNode;
		}
		return node;
	}

	/*
	проверяет является ли объект пустым
	obj - объект для проверки
	*/
	function isEmpty(obj) {
		for (let key in obj) {
    		// если тело цикла начнет выполняться - значит в объекте есть свойства
    		return false;
		}
		return true;
	}

	let textEdit = document.querySelector('.text-editor');
	let but5 = document.querySelector('.but5');
	let but6 = document.querySelector('.but6');
	let but7 = document.querySelector('.but7');
	let but8 = document.querySelector('.but8');
	let close = document.querySelector('.open-post .close');
	let openPost = document.querySelector('.open-post');
	let posts = document.querySelector('.open-post .posts');
	let noPosts = document.querySelector('.open-post .no-post');
	let closeName = document.querySelector('.enter-name .close-name');
	let createName = document.querySelector('.enter-name .create-name');
	let textName = document.querySelector('.enter-name .text-name');

	let currentPostName = '';

	/*
	очищает текстовое поле
	*/
	function clearTextEditor(){
		textEdit.innerHTML = '';
	}

	//открытие списка постов
	but5.onclick = (event) => {
		openPost.style.display = 'block';
		noPosts.style.display = "none";
		//запрашиваем список постов
		fetch('/script/getPosts.php')
		.then((response) => {
			return response.json();
		})
		.then((data) => {
			//проверяем есть ли посты в списке
			if(isEmpty(data) == false){
				for(let item in data){
					//добавляем полученные посты в список постов
	                posts.innerHTML += '<div class = post><div>' +
					data[item].name + '</div><div>' +
					data[item].content.slice(0,50) + '</div></div>';
				}
			} else {
				//выводим надпись что постов нет
				noPosts.style.display = "block";
			}
		});
	}

	//выбор поста из списка
	posts.onclick = (event) => {
		//ищем блок поста на который нажали
		let postBlock = findParentNode2(event.target, 'post');
		//получаем имя и содержимое поста
		currentPostName = postBlock.firstChild.innerText;
		textEdit.innerText = postBlock.lastChild.innerHTML;
		//очищаем список постов
		posts.innerHTML = '';
		openPost.style.display = 'none';
	}

	//закрываем список постов
	close.onclick = (event) => {
		posts.innerHTML = '';
		openPost.style.display = 'none';
	}

	//сохраняем текущий пост
	but6.onclick = (event) => {
		let post = {
			name: currentPostName,
			content: textEdit.innerText,
		};
		fetch('/script/savePost.php',{
			method: 'POST',
			body: JSON.stringify(post),
			headers: {
      			'Content-Type': 'application/json;charset=utf-8'
    		},
		})
	}

	//открытие окна создания поста
	but7.onclick = (event) => {
        let ename = document.querySelector('.enter-name');
        ename.style.display = "block";
    }

	//создаем пост
    createName.onclick = (event) => {
        let ename = document.querySelector('.enter-name');
        ename.style.display = "none";
        fetch('/script/createPost.php',{
			method: 'POST',
                body: JSON.stringify({name: textName.innerText,
                                     content: textEdit.innerText}),
			headers: {
      			'Content-Type': 'application/json;charset=utf-8'
    		},
		})
    }

	//закрыть окно создания поста
	closeName.onclick = (event) => {
		let ename = document.querySelector('.enter-name');
		ename.style.display = "none";
	}

	//удаление поста
	but8.onclick = (event) => {
		if(currentPostName == '') return;
        clearTextEditor();
		fetch('/script/deletePost.php',{
			method: 'POST',
                body: JSON.stringify({name: currentPostName}),
			headers: {
      			'Content-Type': 'application/json;charset=utf-8'
    		},
		})
		currentPostName == '';
    }

</script>
<?php
}
?>
