import { useAuth } from "@/lib/auth";
import { useNavigate } from "react-router-dom";
import { Button } from "@/components/ui/button";
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
import { useToast } from "@/components/ui/use-toast";
import { FileUp, Users, Mail, Calendar } from "lucide-react";

const Admin = () => {
  const { user, logout } = useAuth();
  const navigate = useNavigate();
  const { toast } = useToast();

  const handleLogout = () => {
    logout();
    navigate("/");
  };

  const handleFileUpload = () => {
    toast({
      title: "Coming Soon",
      description: "File upload functionality will be available soon.",
    });
  };

  const handleEmailSend = () => {
    toast({
      title: "Coming Soon",
      description: "Email functionality will be available soon.",
    });
  };

  if (!user || user.role !== "admin") {
    navigate("/");
    return null;
  }

  return (
    <div className="min-h-screen bg-gray-50">
      <header className="bg-white shadow">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
          <h1 className="text-2xl font-bold text-gray-900">Admin Dashboard</h1>
          <Button onClick={handleLogout} variant="outline">
            Logout
          </Button>
        </div>
      </header>
      
      <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <Tabs defaultValue="permits" className="space-y-6">
          <TabsList className="grid w-full grid-cols-4 lg:w-[400px]">
            <TabsTrigger value="permits">Permits</TabsTrigger>
            <TabsTrigger value="users">Users</TabsTrigger>
            <TabsTrigger value="documents">Documents</TabsTrigger>
            <TabsTrigger value="emails">Emails</TabsTrigger>
          </TabsList>

          <TabsContent value="permits" className="space-y-4">
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              <Card>
                <CardHeader>
                  <CardTitle>Access Card Renewals</CardTitle>
                  <CardDescription>Due every two years</CardDescription>
                </CardHeader>
                <CardContent>
                  <Button className="w-full" onClick={handleFileUpload}>
                    <Calendar className="mr-2 h-4 w-4" />
                    View Renewals
                  </Button>
                </CardContent>
              </Card>
              
              <Card>
                <CardHeader>
                  <CardTitle>Annual Permits</CardTitle>
                  <CardDescription>Yearly renewal required</CardDescription>
                </CardHeader>
                <CardContent>
                  <Button className="w-full" onClick={handleFileUpload}>
                    <Calendar className="mr-2 h-4 w-4" />
                    Manage Permits
                  </Button>
                </CardContent>
              </Card>
              
              <Card>
                <CardHeader>
                  <CardTitle>Pending Reviews</CardTitle>
                  <CardDescription>Applications awaiting approval</CardDescription>
                </CardHeader>
                <CardContent>
                  <Button className="w-full" onClick={handleFileUpload}>
                    <FileUp className="mr-2 h-4 w-4" />
                    Review Applications
                  </Button>
                </CardContent>
              </Card>
            </div>
          </TabsContent>

          <TabsContent value="users" className="space-y-4">
            <Card>
              <CardHeader>
                <CardTitle>User Management</CardTitle>
                <CardDescription>Manage system users</CardDescription>
              </CardHeader>
              <CardContent>
                <Button className="w-full">
                  <Users className="mr-2 h-4 w-4" />
                  View Users
                </Button>
              </CardContent>
            </Card>
          </TabsContent>

          <TabsContent value="documents" className="space-y-4">
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              <Card>
                <CardHeader>
                  <CardTitle>File Management</CardTitle>
                  <CardDescription>Upload and download files</CardDescription>
                </CardHeader>
                <CardContent>
                  <Button className="w-full" onClick={handleFileUpload}>
                    <FileUp className="mr-2 h-4 w-4" />
                    Manage Files
                  </Button>
                </CardContent>
              </Card>
            </div>
          </TabsContent>

          <TabsContent value="emails" className="space-y-4">
            <Card>
              <CardHeader>
                <CardTitle>Email System</CardTitle>
                <CardDescription>Send emails to users</CardDescription>
              </CardHeader>
              <CardContent>
                <Button className="w-full" onClick={handleEmailSend}>
                  <Mail className="mr-2 h-4 w-4" />
                  Compose Email
                </Button>
              </CardContent>
            </Card>
          </TabsContent>
        </Tabs>
      </main>
    </div>
  );
};

export default Admin;