Custom severity levels are not available. Only the eight
[RFC 5424](http://tools.ietf.org/html/rfc5424) levels (debug, info, notice,
warning, error, critical, alert, emergency) are present for basic filtering
purposes, but for sorting and other use cases that would require
flexibility, you should add Processors to the Logger that can add extra
information (tags, user ip, ..) to the records before they are handled.

## Log Levels

Monolog supports the logging levels described by [RFC 5424](http://tools.ietf.org/html/rfc5424).

- **DEBUG** (100): Detailed debug information.

- **INFO** (200): Interesting events. Examples: User logs in, SQL logs.

- **NOTICE** (250): Normal but significant events.

- **WARNING** (300): Exceptional occurrences that are not errors. Examples:
  Use of deprecated APIs, poor use of an API, undesirable things that are not
  necessarily wrong.

- **ERROR** (400): Runtime errors that do not require immediate action but
  should typically be logged and monitored.

- **CRITICAL** (500): Critical conditions. Example: Application component
  unavailable, unexpected exception.

- **ALERT** (550): Action must be taken immediately. Example: Entire website
  down, database unavailable, etc. This should trigger the SMS alerts and wake
  you up.

- **EMERGENCY** (600): Emergency: system is unusable.