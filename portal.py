from flask import Flask, render_template, request, redirect, url_for

app = Flask(__name__)

# Define a fake database of users for demonstration purposes
users = {
    'john': 'password123',
    'jane': 'password456'
}

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/login', methods=['POST'])
def login():
    username = request.form['username']
    password = request.form['password']

    if username in users and users[username] == password:
        # Authentication successful, redirect to a success page or perform further actions
        return redirect(url_for('success'))
    else:
        # Authentication failed, redirect back to the login page with an error message
        return redirect(url_for('index', error='Invalid username or password'))

@app.route('/success')
def success():
    return 'Login successful!'

if __name__ == '__main__':
    app.run(debug=True)
