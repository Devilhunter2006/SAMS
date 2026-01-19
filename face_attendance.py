import cv2
import face_recognition
import requests


API_URL = "http://127.0.0.1:8000/api/mark-attendance"


students = {
    1: "faces/Varun.png",   # student_id = 1
}

subject_id = 1  # hardcoded subject (later make dynamic)

# Load known faces
known_encodings = []
student_ids = []

for sid, path in students.items():
    img = face_recognition.load_image_file(path)
    enc = face_recognition.face_encodings(img)[0]
    known_encodings.append(enc)
    student_ids.append(sid)

# Start webcam
cap = cv2.VideoCapture(0)

marked = set()

while True:
    ret, frame = cap.read()
    rgb = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)

    faces = face_recognition.face_locations(rgb)
    encodings = face_recognition.face_encodings(rgb, faces)

    for enc, loc in zip(encodings, faces):
        matches = face_recognition.compare_faces(known_encodings, enc, tolerance=0.5)
        if True in matches:
            idx = matches.index(True)
            student_id = student_ids[idx]

            if student_id not in marked:
                # ✅ Send attendance to Laravel
                res = requests.post(API_URL, json={
                    "student_id": student_id,
                    "subject_id": subject_id
                })
                if res.status_code == 200:
                    print(f"✅ Marked present: {student_id}")
                    marked.add(student_id)

        # Draw rectangle around detected face
        top, right, bottom, left = loc
        cv2.rectangle(frame, (left, top), (right, bottom), (0, 255, 0), 2)

    cv2.imshow("Attendance Camera", frame)
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

cap.release()
cv2.destroyAllWindows()
