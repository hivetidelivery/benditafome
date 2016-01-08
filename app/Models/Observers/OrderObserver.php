<?php

namespace BenditaFome\Models\Observers;

class OrderObserver {

    public function updated($model)
    {
        echo "alterado";
    }

}