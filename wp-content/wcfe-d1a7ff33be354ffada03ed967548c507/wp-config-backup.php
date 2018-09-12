<?php

# No direct access
$secureSrcClassName  = 'WCFE\Modules\Editor\Model\EmergencyRestore';
( class_exists( $secureSrcClassName ) && ( get_class( $this ) == $secureSrcClassName ) && $this->isConfirmed() ) or die( 'Access Denied' );


return array( 'content' => 'PD9waHAKLyoqCiAqIFRoZSBiYXNlIGNvbmZpZ3VyYXRpb25zIG9mIHRoZSBXb3JkUHJlc3MuCiAqCiAqIFRoaXMgZmlsZSBoYXMgdGhlIGZvbGxvd2luZyBjb25maWd1cmF0aW9uczogTXlTUUwgc2V0dGluZ3MsIFRhYmxlIFByZWZpeCwKICogU2VjcmV0IEtleXMsIFdvcmRQcmVzcyBMYW5ndWFnZSwgYW5kIEFCU1BBVEguIFlvdSBjYW4gZmluZCBtb3JlIGluZm9ybWF0aW9uCiAqIGJ5IHZpc2l0aW5nIHtAbGluayBodHRwOi8vY29kZXgud29yZHByZXNzLm9yZy9FZGl0aW5nX3dwLWNvbmZpZy5waHAgRWRpdGluZwogKiB3cC1jb25maWcucGhwfSBDb2RleCBwYWdlLiBZb3UgY2FuIGdldCB0aGUgTXlTUUwgc2V0dGluZ3MgZnJvbSB5b3VyIHdlYiBob3N0LgogKgogKiBUaGlzIGZpbGUgaXMgdXNlZCBieSB0aGUgd3AtY29uZmlnLnBocCBjcmVhdGlvbiBzY3JpcHQgZHVyaW5nIHRoZQogKiBpbnN0YWxsYXRpb24uIFlvdSBkb24ndCBoYXZlIHRvIHVzZSB0aGUgd2ViIHNpdGUsIHlvdSBjYW4ganVzdCBjb3B5IHRoaXMgZmlsZQogKiB0byAid3AtY29uZmlnLnBocCIgYW5kIGZpbGwgaW4gdGhlIHZhbHVlcy4KICoKICogQHBhY2thZ2UgV29yZFByZXNzCiAqLwoKLy8gKiogTXlTUUwgc2V0dGluZ3MgLSBZb3UgY2FuIGdldCB0aGlzIGluZm8gZnJvbSB5b3VyIHdlYiBob3N0ICoqIC8vCgoKLyoqCiogIFRoZSBuYW1lIG9mIHRoZSBkYXRhYmFzZSBmb3IgV29yZFByZXNzCiovCmRlZmluZSgnREJfTkFNRScsICdpZ3VpZGV5b3VfdG91cnMnKTsKCi8qKgoqICBNeVNRTCBkYXRhYmFzZSB1c2VybmFtZQoqLwpkZWZpbmUoJ0RCX1VTRVInLCAnaWd1aWRleW91dXNlcicpOwoKLyoqCiogIE15U1FMIGRhdGFiYXNlIHVzZXJuYW1lCiovCmRlZmluZSgnREJfUEFTU1dPUkQnLCAnZ3RndGNMQTNAJyk7CgovKioKKiAgTXlTUUwgaG9zdG5hbWUKKi8KZGVmaW5lKCdEQl9IT1NUJywgJ2xvY2FsaG9zdCcpOwoKLyoqCiogIERhdGFiYXNlIENoYXJzZXQgdG8gdXNlIGluIGNyZWF0aW5nIGRhdGFiYXNlIHRhYmxlcy4KKi8KZGVmaW5lKCdEQl9DSEFSU0VUJywgJ3V0ZjgnKTsKCi8qKgoqICBUaGUgRGF0YWJhc2UgQ29sbGF0ZSB0eXBlLiBEb24ndCBjaGFuZ2UgdGhpcyBpZiBpbiBkb3VidC4KKi8KZGVmaW5lKCdEQl9DT0xMQVRFJywgJycpOwoKLyoqCiogIFdvcmRQcmVzcyBEYXRhYmFzZSBUYWJsZSBwcmVmaXguCiogIFlvdSBjYW4gaGF2ZSBtdWx0aXBsZSBpbnN0YWxsYXRpb25zIGluIG9uZSBkYXRhYmFzZSBpZiB5b3UgZ2l2ZSBlYWNoIGEgdW5pcXVlCiogIHByZWZpeC4gT25seSBudW1iZXJzLCBsZXR0ZXJzLCBhbmQgdW5kZXJzY29yZXMgcGxlYXNlIQoqLwokdGFibGVfcHJlZml4ID0gJ3dwXyc7CgovKioKKiAgZGlzYWxsb3cgdW5maWx0ZXJlZCBIVE1MIGZvciBldmVyeW9uZSwgaW5jbHVkaW5nIGFkbWluaXN0cmF0b3JzIGFuZCBzdXBlciBhZG1pbmlzdHJhdG9ycy4gVG8gZGlzYWxsb3cgdW5maWx0ZXJlZCBIVE1MIGZvciBhbGwgdXNlcnMsIHlvdSBjYW4gYWRkIHRoaXMgdG8gd3AtY29uZmlnLnBocDoKKi8KZGVmaW5lKCdESVNBTExPV19VTkZJTFRFUkVEX0hUTUwnLCBmYWxzZSk7CgovKioKKiAgCiovCmRlZmluZSgnQUxMT1dfVU5GSUxURVJFRF9VUExPQURTJywgZmFsc2UpOwoKLyoqCiogIFRoZSBlYXNpZXN0IHdheSB0byBtYW5pcHVsYXRlIGNvcmUgdXBkYXRlcyBpcyB3aXRoIHRoZSBXUF9BVVRPX1VQREFURV9DT1JFIGNvbnN0YW50CiovCmRlZmluZSgnV1BfQVVUT19VUERBVEVfQ09SRScsIHRydWUpOwoKLyoqCiogIGZvcmNlcyB0aGUgZmlsZXN5c3RlbSBtZXRob2QKKi8KZGVmaW5lKCdGU19NRVRIT0QnLCAnZGlyZWN0Jyk7CgovKioKKiAgQXV0aGVudGljYXRpb24gVW5pcXVlIEtleXMgYW5kIFNhbHRzLgoqICBDaGFuZ2UgdGhlc2UgdG8gZGlmZmVyZW50IHVuaXF1ZSBwaHJhc2VzIQoqICBZb3UgY2FuIGdlbmVyYXRlIHRoZXNlIHVzaW5nIHRoZSB7QGxpbmsgaHR0cHM6Ly9hcGkud29yZHByZXNzLm9yZy9zZWNyZXQta2V5LzEuMS9zYWx0LyBXb3JkUHJlc3Mub3JnIHNlY3JldC1rZXkgc2VydmljZX0KKiAgWW91IGNhbiBjaGFuZ2UgdGhlc2UgYXQgYW55IHBvaW50IGluIHRpbWUgdG8gaW52YWxpZGF0ZSBhbGwgZXhpc3RpbmcgY29va2llcy4gVGhpcyB3aWxsIGZvcmNlIGFsbCB1c2VycyB0byBoYXZlIHRvIGxvZyBpbiBhZ2Fpbi4KKiAgQHNpbmNlIDIuNi4wCiovCiNkZWZpbmUoJ0FVVEhfS0VZJywgJyo5RWZYQjRWbXw7aj0/TXwuQTFoLl9ZcDxPP11kMCErMVFgU3pfUjBbU0QzYigvfWJKID58aXhwUiAvdXggNisnKTsKI2RlZmluZSgnU0VDVVJFX0FVVEhfS0VZJywgJ0hLeVoqZl0hWiFvIS0/QU0tX3JKJnV5fFVBVUAwXS82M3huUl1KZmIwYjtXfCRrNzsrP3heVT1NIDtHeXg8TFknKTsKI2RlZmluZSgnTE9HR0VEX0lOX0tFWScsICcoPH4kNyl5UHkyMkVAa0B6V21FRytZXStTI081biNTI0tBa3debEggK2wtTTt3W31IUT5VelFOYXJ8RnUuV0lFJyk7CiNkZWZpbmUoJ05PTkNFX0tFWScsICc0bmBibCRgRmEte001cyVuODFiIzBjLiNnW3txOyA6ZGdwNUxQdXhbME86VnUyIT5DSmtlOVktPmE6eUpdYz99Jyk7CiNkZWZpbmUoJ0FVVEhfU0FMVCcsICcqLSUjZ04hYF4xLFMwXWphbUJvQWdTd05VUTktd0lDI3R1Ry98Rn5gV0VjKlpBdnw5RX5LKyw2IzhOQkJXMmgkJyk7CiNkZWZpbmUoJ1NFQ1VSRV9BVVRIX1NBTFQnLCAnIUosNj4qZyxTT1ZKQDctZFhrTCshLlRoTXUsVGc/Oyt7TWV1PXQ8QjpgJjRrLF0tOVUzIUhvdnomZngyTXNWMycpOwojZGVmaW5lKCdMT0dHRURfSU5fU0FMVCcsICcpOTlzaihvfTtpPT9pYGkxWytwM2xvcTk2MlksVnh0OGReO3FFMThBeGk/XS9tbHtFTFdVWiQ3cEo/M3tKXjM8Jyk7CiNkZWZpbmUoJ05PTkNFX1NBTFQnLCAnOHNmUCo8en1yIC12dlI9SWNydTlPUnwlMlpERjc/QTNpK2guNUhsK3RjQUp6KzY2Tip0eUBnQz4pYm9OPFp6VScpOwoKLyoqCiogIEZvciBkZXZlbG9wZXJzOiBXb3JkUHJlc3MgZGVidWdnaW5nIG1vZGUuCiogIENoYW5nZSB0aGlzIHRvIHRydWUgdG8gZW5hYmxlIHRoZSBkaXNwbGF5IG9mIG5vdGljZXMgZHVyaW5nIGRldmVsb3BtZW50LgoqICBJdCBpcyBzdHJvbmdseSByZWNvbW1lbmRlZCB0aGF0IHBsdWdpbiBhbmQgdGhlbWUgZGV2ZWxvcGVycyB1c2UgV1BfREVCVUcKKiAgaW4gdGhlaXIgZGV2ZWxvcG1lbnQgZW52aXJvbm1lbnRzLgoqLwpkZWZpbmUoJ1dQX0RFQlVHJywgZmFsc2UpOwpkZWZpbmUoJ1dQX0RFQlVHX0xPRycsIGZhbHNlKTsKZGVmaW5lKCdXUF9ERUJVR19ESVNQTEFZJywgdHJ1ZSk7CgovKioKKiAgRm9yIGRldmVsb3BlcnM6IFdvcmRQcmVzcyBTY3JpcHQgRGVidWdnaW5nCiogIEZvcmNlIFdvcmRwcmVzcyB0byB1c2UgdW5taW5pZmllZCBKYXZhU2NyaXB0IGZpbGVzCiovCmRlZmluZSgnU0NSSVBUX0RFQlVHJywgZmFsc2UpOwoKLyoqCiogIFdvcmRQcmVzcyBMb2NhbGl6ZWQgTGFuZ3VhZ2UsIGRlZmF1bHRzIHRvIEVuZ2xpc2guCiogIENoYW5nZSB0aGlzIHRvIGxvY2FsaXplIFdvcmRQcmVzcy4gQSBjb3JyZXNwb25kaW5nIE1PIGZpbGUgZm9yIHRoZSBjaG9zZW4KKiAgbGFuZ3VhZ2UgbXVzdCBiZSBpbnN0YWxsZWQgdG8gd3AtY29udGVudC9sYW5ndWFnZXMuIEZvciBleGFtcGxlLCBpbnN0YWxsCiogIGRlX0RFLm1vIHRvIHdwLWNvbnRlbnQvbGFuZ3VhZ2VzIGFuZCBzZXQgV1BMQU5HIHRvICdkZV9ERScgdG8gZW5hYmxlIEdlcm1hbgoqICBsYW5ndWFnZSBzdXBwb3J0LgoqLwpkZWZpbmUoJ1dQTEFORycsICdlcy1FUycpOwoKLyoqCiogIFdoZXJlIHRvIGxvYWQgbGFuZ3VhZ2UncyBmaWxlCiovCmRlZmluZSgnV1BMQU5HX0RJUicsICdlcycpOwoKLyoqCiogIEVuYWJsZSBNdWx0aXNpdGUgZm9yIGN1cnJlbnQgV29yZHByZXNzIGluc3RhbGxhdGlvbgoqLwpkZWZpbmUoJ01VTFRJU0lURScsIHRydWUpOwoKLyoqCiogIFVzZSBzdWIgZG9tYWlucyBmb3IgbmV0d29yayBzaXRlcwoqLwpkZWZpbmUoJ1NVQkRPTUFJTl9JTlNUQUxMJywgdHJ1ZSk7CgovKioKKiAgTXVsdGkgU2l0ZSBEb21haW4KKi8KZGVmaW5lKCdET01BSU5fQ1VSUkVOVF9TSVRFJywgJ2lndWlkZXlvdS50b3VycycpOwojZGVmaW5lKCdOT0JMT0dSRURJUkVDVCcsICcnICk7CiNkZWZpbmUoJ1dQX0hPTUUnLCAnaHR0cDovL2lndWlkZXlvdS50b3VycycpOwojZGVmaW5lKCdXUF9TSVRFVVJMJywgJ2h0dHA6Ly9pZ3VpZGV5b3UudG91cnMnKTsKCgovKioKKiAgTXVsdGkgU2l0ZSBDdXJyZW50IFJvb3QgcGF0aAoqLwpkZWZpbmUoJ1BBVEhfQ1VSUkVOVF9TSVRFJywgJy8nKTsKCi8qKgoqICBNdWx0aSBTaXRlIEN1cnJlbnQgc2l0ZSBJZAoqLwpkZWZpbmUoJ1NJVEVfSURfQ1VSUkVOVF9TSVRFJywgMSk7CgovKioKKiAgTXVsdGkgU2l0ZSBjdXJyZW50IEJsb2cgSWQKKi8KZGVmaW5lKCdCTE9HX0lEX0NVUlJFTlRfU0lURScsIDEpOwoKLyoqCiogIE1lbW9yeSBMaW1pdAoqLwpkZWZpbmUoJ1dQX01FTU9SWV9MSU1JVCcsICc2NE0nKTsKCi8qKgoqICBQb3N0IEF1dG9zYXZlIEludGVydmFsCiovCmRlZmluZSgnQVVUT1NBVkVfSU5URVJWQUwnLCA2MCk7CgovKioKKiAgRGlzYWJsZSAvIEVuYWJsZSBQb3N0IFJldmlzaW9ucyBhbmQgc3BlY2lmeSByZXZpc2lvbnMgbWF4IGNvdW50CiovCmRlZmluZSgnV1BfUE9TVF9SRVZJU0lPTlMnLCB0cnVlKTsKCi8qKgoqICB0aGlzIGNvbnN0YW50IGNvbnRyb2xzIHRoZSBudW1iZXIgb2YgZGF5cyBiZWZvcmUgV29yZFByZXNzIHBlcm1hbmVudGx5IGRlbGV0ZXMgCiogIHBvc3RzLCBwYWdlcywgYXR0YWNobWVudHMsIGFuZCBjb21tZW50cywgZnJvbSB0aGUgdHJhc2ggYmluCiovCmRlZmluZSgnRU1QVFlfVFJBU0hfREFZUycsIDMwKTsKCi8qKgoqICBNYWtlIHN1cmUgYSBjcm9uIHByb2Nlc3MgY2Fubm90IHJ1biBtb3JlIHRoYW4gb25jZSBldmVyeSBXUF9DUk9OX0xPQ0tfVElNRU9VVCBzZWNvbmRzCiovCmRlZmluZSgnV1BfQ1JPTl9MT0NLX1RJTUVPVVQnLCA2MCk7CgovKioKKiAgQ29va2llcyBIYXNoCiovCmRlZmluZSgnQ09PS0lFX0RPTUFJTicsICdpZ3VpZGV5b3UudG91cnMnKTsKCi8qIFRoYXQncyBhbGwsIHN0b3AgZWRpdGluZyEgSGFwcHkgYmxvZ2dpbmcuICovCgovKiogQWJzb2x1dGUgcGF0aCB0byB0aGUgV29yZFByZXNzIGRpcmVjdG9yeS4gKi8KaWYgKCAhZGVmaW5lZCgnQUJTUEFUSCcpICkKCWRlZmluZSgnQUJTUEFUSCcsIGRpcm5hbWUoX19GSUxFX18pIC4gJy8nKTsKCi8qKiBTZXRzIHVwIFdvcmRQcmVzcyB2YXJzIGFuZCBpbmNsdWRlZCBmaWxlcy4gKi8KcmVxdWlyZV9vbmNlKEFCU1BBVEggLiAnd3Atc2V0dGluZ3MucGhwJyk7Cg==' );
