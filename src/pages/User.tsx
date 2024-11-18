import { useAuth } from "@/lib/auth";
import { useNavigate } from "react-router-dom";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { useToast } from "@/components/ui/use-toast";
import { useState, useRef } from "react";
import {
  Card,
  CardContent,
  CardDescription,
  CardHeader,
  CardTitle,
} from "@/components/ui/card";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { Camera, Upload } from "lucide-react";
import { permitService } from "@/lib/permitService";
import { useQuery } from "@tanstack/react-query";

const User = () => {
  const { user, logout } = useAuth();
  const navigate = useNavigate();
  const { toast } = useToast();
  const fileInputRef = useRef<HTMLInputElement>(null);
  const [profileImage, setProfileImage] = useState<string | null>(null);

  const { data: permits } = useQuery({
    queryKey: ['permits'],
    queryFn: permitService.getPermits,
  });

  const handleLogout = () => {
    logout();
    navigate("/");
  };

  const handleFileUpload = async (event: React.ChangeEvent<HTMLInputElement>) => {
    const file = event.target.files?.[0];
    if (file) {
      try {
        await permitService.uploadDocument("1", file); // Using a mock permit ID
        toast({
          title: "Success",
          description: "Document uploaded successfully",
        });
      } catch (error) {
        toast({
          title: "Error",
          description: "Failed to upload document",
          variant: "destructive",
        });
      }
    }
  };

  const handleCameraCapture = () => {
    // Open device camera
    if (fileInputRef.current) {
      fileInputRef.current.click();
    }
  };

  if (!user || user.role !== "user") {
    navigate("/");
    return null;
  }

  return (
    <div className="min-h-screen bg-gray-50">
      <header className="bg-white shadow">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
          <h1 className="text-2xl font-bold text-gray-900">User Dashboard</h1>
          <Button onClick={handleLogout} variant="outline">
            Logout
          </Button>
        </div>
      </header>

      <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {/* Profile Card */}
          <Card>
            <CardHeader>
              <CardTitle>Profile</CardTitle>
              <CardDescription>Update your profile information</CardDescription>
            </CardHeader>
            <CardContent className="space-y-4">
              <div className="flex justify-center mb-4">
                <Avatar className="h-24 w-24">
                  <AvatarImage src={profileImage || ""} />
                  <AvatarFallback>{user.username[0].toUpperCase()}</AvatarFallback>
                </Avatar>
              </div>
              <Input
                type="text"
                placeholder="Username"
                value={user.username}
                readOnly
                className="mb-2"
              />
              <Input
                type="email"
                placeholder="Email"
                value={user.email || ""}
                readOnly
                className="mb-4"
              />
            </CardContent>
          </Card>

          {/* Document Upload Card */}
          <Card>
            <CardHeader>
              <CardTitle>Document Upload</CardTitle>
              <CardDescription>Upload required documents</CardDescription>
            </CardHeader>
            <CardContent className="space-y-4">
              <input
                type="file"
                className="hidden"
                onChange={handleFileUpload}
                ref={fileInputRef}
                accept="image/*,application/pdf"
              />
              <Button
                className="w-full mb-2"
                onClick={() => fileInputRef.current?.click()}
              >
                <Upload className="mr-2 h-4 w-4" />
                Upload Document
              </Button>
              <Button
                className="w-full"
                variant="outline"
                onClick={handleCameraCapture}
              >
                <Camera className="mr-2 h-4 w-4" />
                Take Photo
              </Button>
            </CardContent>
          </Card>

          {/* Permits and Deadlines Card */}
          <Card>
            <CardHeader>
              <CardTitle>Permits & Deadlines</CardTitle>
              <CardDescription>View your active permits</CardDescription>
            </CardHeader>
            <CardContent>
              <div className="space-y-4">
                {permits?.map((permit) => (
                  <div
                    key={permit.id}
                    className="p-4 rounded-lg border bg-white shadow-sm"
                  >
                    <p className="font-medium">{permit.type}</p>
                    <p className="text-sm text-gray-500">
                      Expires: {new Date(permit.expiryDate).toLocaleDateString()}
                    </p>
                    <p className="text-sm mt-1 capitalize">
                      Status: <span className={`text-${permit.status === 'approved' ? 'green' : 'orange'}-600`}>{permit.status}</span>
                    </p>
                  </div>
                ))}
              </div>
            </CardContent>
          </Card>
        </div>
      </main>
    </div>
  );
};

export default User;