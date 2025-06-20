

        <table>
            <thead>
                <tr>
                    <th class="sortable" data-sort="id" data-direction="asc">ID </th>                     
                    <th>商品画像</th>
                    <th>商品名</th>
                    <th class="sortable" data-sort="price" data-direction="asc">価格</th>
                    <th class="sortable" data-sort="stock" data-direction="asc"> 在庫数 </th>
                    <th>メーカー名</th>
                    <th><button class="new-btn" onclick="location.href='{{route('product.create') }}'">新規登録</button></th>
                </tr>
            </thead>
            <tbody>
                <!-- 商品一覧を動的に表示 -->
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td><img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" width="80" height="80" /></td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->company->company_name  }}</td>
                    <td>
                      <div class="button-container">
                         <a href="{{ route('product.show', $product->id) }}">
                          <button class="register-btn">詳細</button>
                         </a>
        
                             <form class="delete-form" data-id="{{ $product->id }}" style="display:inline;">
                                @csrf
                             <button type="submit" class="delete-btn" onclick="return confirm('本当に削除しますか？')">削除</button>
                            </form>
                        </div>
                     </td>
                </tr>
                @endforeach
               
                <!-- 他の商品行を追加 -->
            </tbody>
        </table>