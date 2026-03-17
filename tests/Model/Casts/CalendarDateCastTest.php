<?php

declare(strict_types=1);

namespace Model\Casts;

use Illuminate\Database\Eloquent\Model;
use Maarheeze\CalendarDate\CalendarDate;
use Maarheeze\CalendarDate\Laravel\Model\Casts\CalendarDateCast;
use PHPUnit\Framework\TestCase;
use UnexpectedValueException;

class CalendarDateCastTest extends TestCase
{
    public function testGetReturnsNullForNullValue(): void
    {
        $this->assertNull($this->createCalendarDateCast()->get($this->createModelStub(), 'date', null, []));
    }

    public function testGetReturnsCalendarDateFromString(): void
    {
        $result = $this->createCalendarDateCast()->get($this->createModelStub(), 'date', '2000-01-01', []);

        $this->assertInstanceOf(CalendarDate::class, $result);
        $this->assertEquals('2000-01-01', $result->format('Y-m-d'));
    }

    public function testGetThrowsForUnexpectedType(): void
    {
        $this->expectException(UnexpectedValueException::class);

        $this->createCalendarDateCast()->get($this->createModelStub(), 'date', 12345, []);
    }

    public function testSetReturnsNullForNullValue(): void
    {
        $this->assertNull($this->createCalendarDateCast()->set($this->createModelStub(), 'date', null, []));
    }

    public function testSetReturnsStringFromCalendarDate(): void
    {
        $calendarDate = CalendarDate::createFromFormat('Y-m-d', '2000-01-01');

        $result = $this->createCalendarDateCast()->set($this->createModelStub(), 'date', $calendarDate, []);

        $this->assertEquals('2000-01-01', $result);
    }

    public function testSetThrowsForUnexpectedType(): void
    {
        $this->expectException(UnexpectedValueException::class);

        $this->createCalendarDateCast()->set($this->createModelStub(), 'date', 12345, []);
    }

    private function createCalendarDateCast(): CalendarDateCast
    {
        return new CalendarDateCast();
    }

    private function createModelStub(): Model
    {
        return $this->createStub(Model::class);
    }
}
