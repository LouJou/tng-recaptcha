# tng-recaptcha
Curl based recaptcha V2 implementation for TNG genealogy v12 software

BACKGROUND:
The existing recaptchalib.php library uses an implementation of "file_get_contents()" which doesn't return a verification response from Google when the recaptcha v2 option is activated in TNG version 12.

PROPOSED SOLUTION:
By substituting the file_get_contents() implementation with a curl implementation a verification response is received from Google which is used to permit the sending of the suggestion email when the recaptcha is solved succesfully.

IMPLEMENTATION
The implemented solution is accessable at:
http://www.familiebande.co.za/tng/suggest.php?enttype=I&ID=I335&tree=tree1

DISCLAIMER AND COPYRIGHT ACKNOWLEDGEMENTS
The specific solution suggested is a modification to existing code owned and maintained by their respective owners and is provided with no guarantees whatsoever and is used at the user's own risk.
In respect of potential copyright issues only minimal parts of the existing code is included to assist in identification of the areas where modifications have been introduced as part of this solution.
