@if ($action == 'select')
    <div>
        <?php
        $dash = str_repeat('--', $level);
        ?>
        @foreach ($childs as $child)
            <option value="{{ $child->id }}">{{ $dash }}{{ $child->name }}</option>
            @if (count($child->childs))
                @include('categories.child', [
                    'childs' => $child->childs,
                    'level' => $level + 1,
                    'action' => 'select',
                ])
            @endif
        @endforeach
    </div>
@endif

@if ($action == 'checkbox')
    @foreach ($childs as $child)
        <div class="list-group">

            <li class="list-group-item">
                <input type="checkbox" class="form-check-input ms-1" name="news-category[]" value="{{ $child->id }}"
                    id="{{ $child->name }}">
                <label class="form-check-label ms-1" for="{{ $child->name }}">{{ $child->name }}</label>
                <ul>
                    @if (count($child->childs))
                        @include('categories.child', ['childs' => $child->childs, 'action' => 'checkbox'])
                    @endif
                </ul>
            </li>
        </div>
    @endforeach
    <script>
        $('input[type="checkbox"]').change(function(e) {

            var checked = $(this).prop("checked"),
                container = $(this).parent(),
                siblings = container.siblings();

            container.find('input[type="checkbox"]').prop({
                indeterminate: false,
                checked: checked
            });

            function checkSiblings(el) {

                var parent = el.parent().parent(),
                    all = true;

                el.siblings().each(function() {
                    let returnValue = all = ($(this).children('input[type="checkbox"]').prop("checked") ===
                        checked);
                    return returnValue;
                });

                if (all && checked) {

                    parent.children('input[type="checkbox"]').prop({
                        indeterminate: false,
                        checked: checked
                    });

                    checkSiblings(parent);

                } else if (all && !checked) {

                    parent.children('input[type="checkbox"]').prop("checked", checked);
                    parent.children('input[type="checkbox"]').prop("indeterminate", (parent.find(
                        'input[type="checkbox"]:checked').length > 0));
                    checkSiblings(parent);

                } else {

                    el.parents("li").children('input[type="checkbox"]').prop({
                        indeterminate: true,
                        checked: false
                    });

                }

            }

            checkSiblings(container);
        });
    </script>
@endif

@if ($action == 'category_list')
    <ul class="submenu dropdown-menu">
        @foreach ($childs as $child)
            <li><a class="dropdown-item" href="{{ route('home.guset', $child->id) }}">{{ $child->name }} news </a>

                @if (count($child->childs))
                    @include('categories.child', ['childs' => $child->childs, 'action' => 'category_list'])
                @endif
            </li>
        @endforeach
    </ul>
@endif
