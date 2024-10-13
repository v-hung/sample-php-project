<?php

class MailController {

    public function send() {
        $data = [];

        $companies = query("SELECT * FROM companies");
        $posts = query("SELECT * FROM posts");

        if (count($posts) == 0) {
            echo "No posts found";
            return;
        }

        $posts_companies = query("SELECT * from posts_companies");
        $posts_companies_map = [];

        foreach ($posts_companies as $relation) {
            $posts_companies_map[$relation['company_id']][] = $relation['post_id'];
        }

        foreach ($companies as $index => $company) {

            // $company_posts_sent = array_filter($posts_companies, function ($post) use ($company) {
            //     return $post['company_id'] == $company['id'];
            // });
            // $company_posts_sentId = array_column($company_posts_sent, 'post_id');

            $company_posts_sentId = $posts_companies_map[$company['id']] ?? [];
            
            $company_posts_unsent = array_filter($posts, function ($post) use ($company_posts_sentId) {
                return !in_array($post['id'], $company_posts_sentId);
            });
            
            if (!empty($company_posts_unsent)) {

                $companies[$index]['employees'] = query("SELECT * FROM {$company['code']}_employees");
                $companies[$index]['company_posts_unsent'] = $company_posts_unsent;

                $this->sendMailToEmployees($companies[$index]);

                $data[$company['code']] = array_column($company_posts_unsent, 'id');
            }

        }

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function sendMailToEmployees($company) {
        
        $chunks = array_chunk($company['employees'], 5);

        foreach ($chunks as $chunk) {

            foreach($chunk as $employee) {
                $html = $this->htmlMailTemplate($company['company_posts_unsent']);
                $this->sendMail($employee['email'], $html);
            }
        }

        foreach($company['company_posts_unsent'] as $post) {
            $sql = "INSERT INTO posts_companies (post_id, company_id) VALUES (:post_id, :company_id)";
            $params = [
                "post_id" => $post['id'],
                "company_id" => $company['id']
            ];
            execute($sql, $params);
        }
    }

    public function sendMail($to, $body) {
        $logFile = ROOTPATH. '/logs/log.txt';

        $handle = fopen($logFile, 'a');

        if ($handle) {
            fwrite($handle, "Sending mail to $to\n");
            fwrite($handle, "Body: $body\n");
            fwrite($handle, "\n");
            fclose($handle);
        }
    } 

    public function htmlMailTemplate($posts) {
        $html = "What news - ";

        foreach ($posts as $index => $post) {
            $html .= "{$post['title']}, ";
        }

        return $html;
    }

}