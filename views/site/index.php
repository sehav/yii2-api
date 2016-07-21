<?php

/* @var $this yii\web\View */

$this->title = 'Мини админка';

$js = <<< JS
$(function(){
    $('#author-form').submit(function(e){
        e.preventDefault();
        var data=$(this).serialize();
        $.ajax({
            url: $(this).attr('action'),
            type:'POST',
            data:data,
            dataType:'json',
            success:function(data, textStatus){
                location.reload();
            }
        });
    });
    
    $('#book-form').submit(function(e){
        e.preventDefault();
        var data=$(this).serialize();
        $.ajax({
            url: $(this).attr('action'),
            type:'POST',
            data:data,
            dataType:'json',
            success:function(data, textStatus){
                location.reload();
            }
        });
    });
    
    $('#authors-books-form').submit(function(e){
        e.preventDefault();
        var data=$(this).serialize();
        $.ajax({
            url: $(this).attr('action'),
            type:'POST',
            data:data,
            dataType:'json',
            success:function(data, textStatus){
                location.reload();
            }
        });
    });
    
    $('body').on('submit','.edit-form',function(e){
        e.preventDefault();
        var data=$(this).serialize();
        $.ajax({
            url: $(this).attr('action'),
            type:'POST',
            data:data,
            dataType:'json',
            success:function(data, textStatus){
                location.reload();
            }
        });    
    })
    
    $('body').on('click','.delete',function(e){
        e.preventDefault();
        var t=$(this);
        $.ajax({
            url: $(this).attr('href'),
            type:'DELETE',
            dataType:'json',
            success:function(data, textStatus){
                console.log(data);
            },
            statusCode: {
                204: function() {
                  t.closest('tr').remove();
                  location.reload();
                }
            }
        });
    });
    
    $('body').on('click','.edit',function(e){
        e.preventDefault();
        var t=$(this);
        var action=t.attr('href');
        var model=t.data('model');
        var modal=$('.edit-'+model);
        modal.find('.edit-form').attr('action',action);
        modal.modal('show');
    });
});
JS;
$this->registerJs($js, yii\web\View::POS_END);

?>
<div class="row">
    <h3>Авторы</h3>
    <table class="table" id="authors-table">
        <thead>
        <tr>
            <th>#ID</th>
            <th>Имя Автора</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($authors as $author): ?>
            <tr>
                <td>#<?= $author->id; ?></td>
                <td><?= $author->name; ?></td>
                <td>
                    <a href="/web/v1/author/<?= $author->id; ?>" class="edit" data-model="author">Редактировать</a>
                    <a href="/web/v1/author/<?= $author->id; ?>" class="delete">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <form id="author-form" role="form" method="post" action="/web/v1/author" class="form-inline">
        <div class="form-group">
            <input type="text" name="ApiAuthor[name]" class="form-control" placeholder="Имя автора">
        </div>
        <button type="submit" class="btn btn-default">Добавить автора</button>
    </form>
</div>

<div class="row">
    <h3>Книги</h3>
    <table class="table" id="books-table">
        <thead>
        <tr>
            <th>#ID</th>
            <th>Название книги</th>
            <th>Обложка</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($books as $book): ?>
            <tr>
                <td>#<?= $book->id; ?></td>
                <td><?= $book->title; ?></td>
                <td><?= $book->coverUrl; ?></td>
                <td>
                    <a href="/web/v1/book/<?= $book->id; ?>" class="edit" data-model="book">Редактировать</a>
                    <a href="/web/v1/book/<?= $book->id; ?>" class="delete">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <form id="book-form" role="form" method="post" action="/web/v1/book" class="form-inline">
        <div class="form-group">
            <input type="text" name="ApiBook[title]" class="form-control" placeholder="Название книги">
        </div>
        <div class="form-group">
            <input type="text" name="ApiBook[coverUrl]" class="form-control" placeholder="Обложка">
        </div>
        <button type="submit" class="btn btn-default">Добавить книгу</button>
    </form>
</div>

<div class="row">
    <h3>Книги Авторы</h3>
    <table class="table" id="books-table">
        <thead>
        <tr>
            <th>Автор</th>
            <th>Книги</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($authors as $author) {
            if ($abooks = $author->books) {
                foreach ($abooks as $abook):?>
                    <tr>
                        <td><?= $author->name; ?></td>
                        <td><?= $abook->title; ?></td>
                    </tr>
                <?php endforeach;
            }
        } ?>
        </tbody>
    </table>
    <form id="authors-books-form" role="form" method="post" action="/web/v1/book-author" class="form-inline">
        <div class="form-group">
            <select name="author_id" class="form-control" required>
                <?php foreach ($authors as $author): ?>
                    <option value="<?= $author->id; ?>"><?= $author->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <select name="book_id" class="form-control" required>
                <?php foreach ($books as $book): ?>
                    <option value="<?= $book->id; ?>"><?= $book->title; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-default">Связать книгу и автора</button>
    </form>

    <div class="modal fade edit-book" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form role="form" method="post" action="" class="form-inline edit-form">
                    <div class="form-group">
                        <input type="text" name="ApiBook[title]" class="form-control" placeholder="Название книги">
                    </div>
                    <div class="form-group">
                        <input type="text" name="ApiBook[coverUrl]" class="form-control" placeholder="Обложка">
                    </div>
                    <button type="submit" class="btn btn-default">Изменить книгу</button>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade edit-author" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form role="form" method="post" action="" class="form-inline edit-form">
                    <div class="form-group">
                        <input type="text" name="ApiAuthor[name]" class="form-control" placeholder="Имя автора">
                    </div>
                    <button type="submit" class="btn btn-default">Изменить автора</button>
                </form>
            </div>
        </div>
    </div>
</div>
