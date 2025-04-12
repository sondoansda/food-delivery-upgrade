import time
import requests
from concurrent.futures import ThreadPoolExecutor, as_completed

URL = "http://localhost:3000/restaurants" 
TOTAL_REQUESTS = 1000
CONCURRENT_REQUESTS = 1000

response_times = []
failed_requests = 0

def send_request(index):
    global failed_requests
    start_time = time.time()
    try:
        response = requests.get(URL, timeout=10)
        if response.status_code == 200:
            print(f"✅ #{index} OK")
            return time.time() - start_time
        else:
            print(f"❌ #{index} Failed: {response.status_code}")
            failed_requests += 1
            return None
    except Exception as e:
        print(f"💥 #{index} Error: {e}")
        failed_requests += 1
        return None

start = time.time()
with ThreadPoolExecutor(max_workers=CONCURRENT_REQUESTS) as executor:
    futures = [executor.submit(send_request, i) for i in range(1, TOTAL_REQUESTS + 1)]
    for future in as_completed(futures):
        result = future.result()
        if result is not None:
            response_times.append(result)
end = time.time()

print("\n📊 Test Summary:")
print({
    "Total Requests": TOTAL_REQUESTS,
    "Successful": len(response_times),
    "Failed": failed_requests,
    "Total Duration (s)": round(end - start, 2),
})
