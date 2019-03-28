using System;
using System.Net.Http;
using System.Net.Http.Headers;
using System.Text;
using System.Threading.Tasks;

namespace LGPS_Ws_Client
{
    class Program
    {
        static void Main(string[] args)
        {
            // Config Url depends of Documentation
            var base_url = "http://ws.intralix.com";  
            var uri = "/api/v1/lgps/...";  
            var api_token = "API_TOKEN"; // Provided Token

            // HTTP POST Configuration
            var client = new System.Net.Http.HttpClient();
            client.BaseAddress = new Uri(base_url);
            client.DefaultRequestHeaders.Accept.Add(new MediaTypeWithQualityHeaderValue("application/json"));
            client.DefaultRequestHeaders.Authorization = new AuthenticationHeaderValue("Bearer", api_token);                
            
            // Body Configuration
            var data = "{\"client_id\":\"00377\"}"; // Ws Parameters (depends on documentation)
            var contentRes = new StringContent(data.ToString(), Encoding.UTF8, "application/json");
            
            // Request data
            var response = client.PostAsync(uri, contentRes).Result;

            string res = "";
            using (HttpContent content = response.Content)
            {
                // ... Read the string.
                Task<string> result = content.ReadAsStringAsync();
                res = result.Result;
                Console.WriteLine(res);
                Console.ReadLine();
            }
        }
    }
}
