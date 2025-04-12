from locust import HttpUser, task, between

class MyUser(HttpUser):
    wait_time = between(1, 3)  # mỗi user đợi 1–3 giây trước khi request tiếp

    @task
    def get_restaurants(self):
        self.client.get("/restaurants")
