<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribers List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">
    <div class="w-full max-w-4xl mx-auto p-6 bg-gray-800 rounded-lg">
        <h1 class="text-3xl font-bold text-center mb-6">Subscribers List 📩</h1>
        
        <table class="w-full border-collapse border border-gray-700">
            <thead>
                <tr class="bg-gray-700">
                    <th class="border border-gray-600 px-4 py-2">#</th>
                    <th class="border border-gray-600 px-4 py-2">Email</th>
                    <th class="border border-gray-600 px-4 py-2">Subscribed At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subscribers as $index => $subscriber)
                    <tr class="bg-gray-800">
                        <td class="border border-gray-600 px-4 py-2">{{ $loop->iteration + ($subscribers->currentPage() - 1) * $subscribers->perPage() }}</td>
                        <td class="border border-gray-600 px-4 py-2">{{ $subscriber->email }}</td>
                        <td class="border border-gray-600 px-4 py-2">{{ $subscriber->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="border border-gray-600 px-4 py-2 text-center">No subscribers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $subscribers->links() }}
        </div>
    </div>
</body>
</html>
