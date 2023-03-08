- Create a DO Node
- Create a user: adduser XXXXXXX
- Sudo the user: usermod -aG sudo XXXXXXX
- Exit off the server
- Test you can connect XXXXX@ip
- Remove root login: `sudo nano /etc/ssh/sshd_config`: PermitRootLogin yes change to: no

go to your home dir: /home/XXXXXXX

Clone repo `git clone https://github.com/viion/saeris`

cd into it

Make sure `server/build` nginx config `sudo cp` path is correct:
- sudo cp ~/saeris/server/common /etc/nginx/sites-available/common

run: `sudo bash server/build`
