<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
  public function transform(User $user)
  {
    return [
      'id' => $user->id,
      'nama' => $user->name,
      'alamat' => $user->address,
      'phone' => $user->no_phone,
      'registered' => $user->created_at->diffForHumans()
    ];
  }
}
