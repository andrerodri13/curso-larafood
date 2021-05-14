@include('admin.includes.alerts')

<div class="form-group">
    <label for="name">Nome:</label>
    <input type="text" name="name" class="form-control" id="name" placeholder="Nome:" value="{{$plan->name ?? old('name')}}">
</div>
<div class="form-group">
    <label for="price">Preço:</label>
    <input type="text" name="price" class="form-control" id="price" placeholder="Preço:" value="{{$plan->price ?? old('price')}}">
</div>
<div class="form-group">
    <label for="description">Descrição:</label>
    <input type="text" name="description" class="form-control" id="description" value="{{$plan->description ?? old('description')}}"
           placeholder="Descrição:">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>
