<?php

namespace App\Transformers;

use App\AkunVirtual;
use League\Fractal\TransformerAbstract;

class VaTransformer extends TransformerAbstract
{
  public function transform(AkunVirtual $va)
  {
    return [
      'id'                => $va->id,
      'nama_user'         => $va->nama_user,
      'no_virtual_akun'   => $va->no_va,
      'total_pembayaran'  => $va->total_pembayaran,
      'status'            => $va->status,
      'pembuatan_tagihan' => $va->created_at->diffForHumans()
    ];
  }
}
