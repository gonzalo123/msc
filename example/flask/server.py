from flask import Flask, jsonify
app = Flask(__name__)

@app.route('/hello/<username>')
def show_user_profile(username):
    return "Hello %s from flask service" % username

if __name__ == "__main__":
    app.run(debug=True, host='0.0.0.0', port=5000)