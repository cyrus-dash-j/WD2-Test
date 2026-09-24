<?php

use App\Models\Student;
use App\Models\User;

function studentAttributes(): array
{
    return [
        'lastname' => 'Santos',
        'firstname' => 'Alex',
        'province' => 'Metro Manila',
        'country' => 'Philippines',
        'school' => 'AMA University',
        'program' => 'BSCS',
        'year' => 2,
        'birthday' => '2004-05-16',
    ];
}

test('guests can access the landing page and public student records', function () {
    $student = Student::create(studentAttributes());

    $this->get('/')->assertOk()->assertSee('Every student record, in one clear place.');
    $this->get(route('students.index'))
        ->assertOk()
        ->assertSee('Welcome Guest')
        ->assertSee('filterDashboard')
        ->assertSee('programFilter');
    $this->get(route('students.show', $student))->assertOk()->assertSee('Student Profile Sheet');
});

test('guests are redirected from student management routes', function () {
    $student = Student::create(studentAttributes());

    $this->get(route('students.create'))->assertRedirect(route('login'));
    $this->get(route('students.edit', $student))->assertRedirect(route('login'));
    $this->post(route('students.store'), studentAttributes())->assertRedirect(route('login'));
    $this->put(route('students.update', $student), studentAttributes())->assertRedirect(route('login'));
    $this->delete(route('students.destroy', $student))->assertRedirect(route('login'));
});

test('authenticated users can manage student records', function () {
    $user = User::factory()->create();
    $student = Student::create(studentAttributes());

    $this->actingAs($user)->get(route('students.create'))->assertOk();
    $this->actingAs($user)->get(route('students.edit', $student))->assertOk();
    $this->actingAs($user)->put(route('students.update', $student), array_merge(studentAttributes(), ['firstname' => 'Updated']))
        ->assertRedirect(route('students.index'));
    expect($student->refresh()->firstname)->toBe('Updated');

    $this->actingAs($user)->delete(route('students.destroy', $student))->assertRedirect(route('students.index'));
    expect(Student::find($student->id))->toBeNull();
});

test('student management controls are visible only to authenticated users', function () {
    $student = Student::create(studentAttributes());

    $this->get(route('students.index'))
        ->assertDontSee('Add Student Profile')
        ->assertDontSee('Edit Profile')
        ->assertDontSee('Delete');

    $this->actingAs(User::factory()->create())->get(route('students.index'))
        ->assertSee('Add Student Profile')
        ->assertSee('Edit Profile')
        ->assertSee('Delete');
});
