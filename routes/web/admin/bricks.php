<?php

Route::get(
    Lang::uri('brick/edit/{brick}'),
    function () { return; }
)->name('brick.edit');
Route::delete(
    Lang::uri('brick/destroy/{brick}'),
    function () { return; }
)->name('brick.destroy');
