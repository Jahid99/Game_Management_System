# Game_Mangement_System
1. User Registration. The registration asks for their user name, character name, email, and password. Registrations is unique by character name and email.

2. User Profile. The profile show their avatar (default avatar if they don't add one, or delete their current one), character name, rank, and division.User can edit their own avatar (or delete it), user name, character name, email, and password. Anyone viewing the profile cannot edit them, unless they are of a specific rank and division.

3. Ranks and Divisions. There will be 10 Divisions and 5 Ranks per Divisions, so 50 Ranks all together. When someone registers, they get placed in Rank 1 of Division 1. Only users in Division 4 or higher can promote another user to any rank in at least 2 Divisions less than theirs. Only users in the 10th Division can demote a user. Here's a few examples:

3A. User A is Rank 2 of Division 1. User B is Rank 1 of Division 4. User B can promote User A to Ranks 3/4/5 of Division 1 AND Ranks 1/2/3/4/5 of Division 2.

3B. User A is Rank 5 of Division 3. User B is Rank 2 of Division 4. User B cannot promote User A, since Division 3 is only 1 less Division and Division 4 would be the same.

3C. User A is Rank 1 of Division 3. User B is Rank 1 of Division 8. User B can promote User A to Ranks 2/3/4/5 of Division 3 AND Ranks 1/2/3/4/5 of Division 4 AND Ranks 1/2/3/4/5 of Division 5 AND Ranks 1/2/3/4/5 of Division 6.

3D. User A is Rank 5 of Division 9. User B is Rank 1 of Division 10. User B can demote User A to any Rank of any Division. User B cannot promote User A since Division 9 is only 1 less Division and Division 10 would be the same.

4. Simple Forum. A simple "add post" and "reply". However,Admin has the option to be able to set categories and what Ranks/Divisions can access it to post or reply in, but anyone can view them.
