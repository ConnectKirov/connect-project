<?php

class Schedule implements JsonSerializable {
    public $user;
    public $timeStart;
    public $timeEnd;
    public $id;

    public function __construct(
        User $user,
        $timeStart,
        $timeEnd,
        $id
    ) {
        $this->id = $id;
        $this->timeStart = DateTime::createFromFormat('Y-m-d H:i:s', $timeStart);
        $this->timeEnd = DateTime::createFromFormat('Y-m-d H:i:s', $timeEnd);
        $this->user = $user;
    }

    public function jsonSerialize() {

        return [
            'user' => $this->user,
            'id' => $this->id,
            'timeStart' => $this->timeStart->format(DATE_ISO8601),
            'timeEnd' => $this->timeEnd->format(DATE_ISO8601),
        ];
    }

}
