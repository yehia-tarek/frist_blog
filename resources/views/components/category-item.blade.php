<div>
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
    <?php
    $level = 2;
    $dash = str_repeat('--',$level);
    ?>
    @foreach ($category->children as $child)
        <option value="{{$child->id}}">{{$dash}}{{$child->name}}</option>
    @endforeach
</div>
