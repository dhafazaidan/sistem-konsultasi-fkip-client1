* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-image: url("Unsika1.jpg");
    display: flex;
    flex-direction: column;
    align-items: center;
    position: absolute;
}

.header {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #c0a258;
    position: relative;
}

.user-section {
    display: flex;
    align-items: center;
    font-size: 18px;
    color: #fff;
}

.user-section i {
    border-color: #c0a258;
    margin-right: 10px;
    font-size: 24px;
}

.notification i {
    max-width: 50px;
    width: 100vh;
    display: flex;
    justify-content: right;
    align-items: flex-end;
    font-size: 24px;
    color: #fff;
}

.close-btn {
    background: none;
    border: none;
    font-size: 20px;
    color: #fff;
    cursor: pointer;
}

.welcome-section {
    width: 100%;
    position: relative;
    text-align: center;
    margin-top: 20px;
}

.background-image {
    width: 100%;
    height: 300px;
    object-fit: cover;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
}

.welcome-section h1 {
    font-size: 48px;
    color: #fff;
    position: relative;
    margin-top: 100px;
}

h1 {
    text-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
}

.content-section {
    display: flex;
    justify-content: space-around;
    align-items: flex-start;
    width: 80%;
    margin-top: 40px;
}

.left-section, .right-section {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 45%;
}
.welcome-section h2 {
    font-size: 32px;
    color: #fff;
    text-shadow: rgba(0, 0, 0, 0.4);;
    border-color: #fff;
    position: relative;
    text-align: center;
    justify-content: center;
    max-width: 100vh;
    align-items: center;
    margin: 30px 30% 0;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.buttons-group {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center;
}

button {
    background-color: #c0a258;
    color: #fff;
    border: none;
    border-radius: 25px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #b08d3d;
}
.title {
    background-color: #c0a258;
    color: #fff;
    padding: 0 20px;
    border-radius: 10px;
    max-width: 20px;
    margin-top: 20px;
    text-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
}
.content-section0{
    margin: 0 20px;
    width: 80%;
    margin-top: 40px;
    background: #ffffff63;
    border-radius: 20px;
}

.left-section1 {
    margin-top: 20px;
    margin-left: 50px;
    position: relative;
    z-index: 10px;
    max-width: 200px;
}

.left-section1 .span {
    font-size: 1.2em;
    justify-content: center;
    align-items: center;
    color: #fff;
    font-weight: bold;
    background: #c0a258;
    border-radius: 20px;
    max-width: 100%;
    max-width: 400px;
    padding: 10px;
    display: flex;
}

.dosen-list {
    display: flex;
    flex-wrap: wrap;
    position: static;
    justify-content: flex-start;
    padding-left: 20px;
    gap: 20px;
    max-width: 100%;
    margin: 10px auto 10px;
}

.dosen-item {
    margin: 10px 0 10px;
    flex: 0 0 calc(33.333% - 20px);
    max-width: calc(33.333% - 20px);
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    transition: box-shadow 0.3s ease;
}

.dosen-item:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.profile-pic {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 10px;
}

.dosen-name {
    font-weight: bold;
    margin-bottom: 5px;
    text-align: center;
}

.dosen-id {
    font-size: 0.9em;
    color: #666;
    margin-bottom: 10px;
    text-align: center;
}

.chat-button {
    background-color: #d4af37;
    color: white;
    border: none;
    padding: 5px 15px;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.chat-button:hover {
    background-color: #c19b2e;
}
.dash-tittle {
    margin: 0 200px;
    padding: 20px 5px;
    color: rgb(255, 255, 255);
    background-color: rgb(119, 119, 119);
    opacity: 0.4;
    border-radius: 20px;
    display: flex;
    justify-content: baseline;
    width: 100%;
}
.message-list {
    margin-top: 20px;
}
.message-item {
    border: 1px solid #ddd;
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 5px;
}
.message-item p {
    margin: 5px 0;
}
.message-item p strong {
    color: #333;
}
.header {
    background-color: #d4af37;
    color: white;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.user-section, .notification {
    display: flex;
    align-items: center;
}

.user-section i, .notification i {
    margin-right: 10px;
    font-size: 1.2em;
}

.close-btn {
    background: none;
    border: none;
    color: white;
    font-size: 1.2em;
    cursor: pointer;
}

.profile-container {
    max-width: 600px;
    margin: 20px auto;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    padding: 20px;
}

.profile-card {
    text-align: center;
}

.profile-image {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 20px;
}

h2 {
    color: #333;
    margin-bottom: 10px;
}

p {
    color: #666;
    margin: 5px 0;
}

.logout-btn {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #d4af37;
    color: white;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 20px;
    transition: background-color 0.3s;
}

.logout-btn:hover {
    background-color: #c19b2e;
}
/* Untuk seluruh container chat */
.chat-container {
    background: rgba(245, 245, 245, 0.705);
    background-size: contain;
    background-position: center;
    height: 100vh;
    margin: 20px;
    display: flex;
    flex-direction: column;
    position: relative;
    justify-content: space-between;
    font-family: Arial, sans-serif;
    padding: 20px;
    color: #333;
}

/* Header Chat */
.chat-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: rgba(255, 255, 255, 0.8);
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.user-info {
    display: flex;
    align-items: center;
}

.user-info .avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 10px;
}

.user-info strong {
    font-size: 10px;
    margin-bottom: 2px;
    display: block;
}

.user-info .status-online {
    display: inline-block;
    width: 10px;
    height: 10px;
    background-color: #63E6BE;
    border-radius: 50%;
    margin-right: 5px;
}

.chat-actions i {
    font-size: 18px;
    color: #666;
    margin-left: 10px;
    cursor: pointer;
}

/* Badan Chat */
.chat-body {
    flex: 1;
    margin-top: 20px;
    overflow-y: auto;
    padding: 10px;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* Pesan DPA */
.dpa-message {
    background-color: #DAA520; /* Warna pesan DPA */
    color: #fff;
    align-self: flex-start;
    padding: 10px 15px;
    border-radius: 10px 10px 10px 0;
    max-width: 60%;
    font-size: 14px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Pesan User */
.user-message {
    background-color: #808080; /* Warna pesan User */
    color: #fff;
    align-self: flex-end;
    padding: 10px 15px;
    border-radius: 10px 10px 0 10px;
    max-width: 60%;
    font-size: 14px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Form Kirim Pesan */
.chat-form {
    display: flex;
    background-color: rgba(255, 255, 255, 0.9);
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.chat-form textarea {
    flex: 1;
    resize: none;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    font-size: 14px;
    margin-right: 10px;
    outline: none;
}

.chat-form button {
    background-color: #63E6BE;
    border: none;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.chat-form button i {
    font-size: 16px;
}

/* @media (max-width: 768px) {
    .content-section {
        flex-direction: column;
        align-items: center;
    }

    .left-section, .right-section {
        width: 80%;
        margin-bottom: 20px;
    }

    .welcome-section h1 {
        font-size: 36px;
    }
}

/* .toggle {
    margin-top: 20px;
    color: #666;
    cursor: pointer;
} */
/* @media (max-width: 768px) {
    .dosen-item {
        flex: 0 0 calc(50% - 20px);
        max-width: calc(50% - 20px);
    }
}

@media (max-width: 480px) {
    .dosen-item {
        flex: 0 0 100%;
        max-width: 100%;
    }
} */