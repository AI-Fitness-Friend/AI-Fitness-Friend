import org.openqa.selenium.WebDriver;
import org.testng.annotations.BeforeSuite;

import io.github.bonigarcia.wdm.WebDriverManager;

public class LoginTest {
	
	WebDriver driver;

	@BeforeSuite
	public void SetUp() {
		WebDriverManager.chromedriver().setup();
		driver = new ChromeDriver();
	}

	@Test
	Run | Debug
	public void Login() {
		/* Change Domain Address*/
		driver.get("http://gmail.com/");
		driver.manage().window().maximize();
		
		/* Send ID */	
		driver.findElement(By.xpath("//input[@type='email']")).sendKeys("desealvin6");
		
		/* Click Next/LogIn*/
		driver.findElement(By.xpath("//div[@id='identifierNext']")).click(); 

		driver.manage().timeouts().implicitlyWait(3000, TimeUnit.SECONDS);

		/* Send PW */
		driver.findElement(By.xpath("//input[@name='password')).sendKeys("Test@1234");
		driver.findElement(By.xpath("//div[@id='passwordNext']")).click();

	}

	@AfterSuite
	public void quit() {
		driver.quit();
	}

}