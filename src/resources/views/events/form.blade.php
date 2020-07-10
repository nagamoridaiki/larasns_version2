@csrf
<div class="md-form">
  <label>タイトル</label>
  <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
</div>
<div class="form-group">
    <label>イベントイメージ</label>
    <span>推奨サイズ 800×300</span>
    <input type="file" name='image' class="form-control-file">
</div>
<div class="form-group">
  <label></label>
  <textarea name="detail" required class="form-control" rows="16" placeholder="イベント詳細">{{ old('detail') }}</textarea>
</div>
<div class="form-group">
    <label>住所</label>
    <input type="text" name="address" class="form-control" required value="{{ old('address') }}">
</div>
<div class="form-group">
    <label>料金</label>
    <input type="number" name="price" required value="0" >円
</div>
