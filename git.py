import os
import sys

def confirm_choice():
    confirm = input("(Y/N)? ") or "Y"
    if confirm != 'Y' and confirm != 'N':
        print("\nInvalid Option. Please Enter a Valid Option.", end=" ")
        return confirm_choice()
    return confirm

# =====================================================

command = 'cmd /k "git add .'

# =====================================================

print("Commit this changes", end=" ")
commit = confirm_choice()

if commit == "Y":
    msg = input("Enter commit message [default message]: ") or "default message"
    command += ' && git commit -m \"' + msg + '\"'
else:
    sys.exit(0)

# ======================================================

print("Push this changes", end=" ")
push = confirm_choice()

if push == "Y":
    remote = input("Enter remote [origin]: ") or "origin"
    branch = input("Enter branch [master]: ") or "master"
    command += ' && git push -u ' + remote + ' ' + branch
else:
    sys.exit(0)

# ======================================================

command += ' && git status"'

# ======================================================

os.system(command)
