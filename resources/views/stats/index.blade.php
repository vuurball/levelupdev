<h2>Select a skill:</h2>

<select onchange="this.options[this.selectedIndex].value && (window.location = '/index.php/stats/' + this.options[this.selectedIndex].value)">
    <option>Select...</option>
    @foreach($skillsArr as $skill)
    <option vlaue="{{ $skill }}" > {{ $skill }} </option>

    @endforeach
</select>


@if(isset($selectedSkill))
<h3>{{$selectedSkill}}</h3>

@foreach ($relatedSkills as $relatedSkill)
{{ $relatedSkill->get('skillweight') }} {{ $relatedSkill->get('skillname') }} <br>
@endforeach

@endif
